<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Chatmanager;
use App\Models\Login;
use Illuminate\Http\Request;

use App\Models\Manager;
use App\Models\Promotion;
use App\Models\Promotionseller;
use App\Models\Report;
use App\Models\Reserve_area;
use App\Models\Seller;
use App\Models\Shop;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:managers,email',
            'password' => 'required|min:8|max:30',
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('manager')->attempt($creds)) {
            $login = new Login();
            $login->typeuser = 'manager';
            $login->save();
            return redirect()->route('manager.home');
        } else {
            return redirect()->route('manager.login')->with('fail', 'Email หรือ Password ผิดกรุณาใส่รหัสผ่านใหม่');
        }
    }

    public function editseller(Request $request)
    {
        $user_seller = Seller::where('role', 'noseller')->get();
        $countseller = $user_seller->count();
        return view('dashboard.manager.editseller', compact('user_seller', 'countseller'));
    }

    public function updateseller($id)
    {
        $update = Seller::find($id)->update([
            'role' => "seller"
        ]);
        echo "<script>alert('อัพเดตข้อมูลสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/home'</script>";
    }

    public function deleteseller($id)
    {
        $img = Seller::find($id)->image;
        unlink('images/profileseller/' . $img);

        $delete = Seller::find($id)->delete();
        echo "<script>alert('ลบข้อมูลสินค้าสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/home'</script>";
    }

    function editpromotionseller(){
        $promotionseller = Promotionseller::where('status', 'no')->get();
        return view('dashboard.manager.editpromtionseller',compact('promotionseller'));
    }

    function updatestatuspromotor($id){
        $update = Promotionseller::find($id)->update([
            "status" => 'yes'
        ]);
        echo "<script>alert('อัพโปรโมชั่นสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/homepromotionseller'</script>";
    }

    function homepromotionseller(){
        $promotionseller = Promotionseller::where('status','yes')->get();
        return view('dashboard.manager.homepromotionseller',compact('promotionseller'));
    }

    function logout()
    {
        Auth::guard('manager')->logout();
        return redirect('/');
    }

    function homecreatepromotion()
    {

        return view('dashboard.manager.createpromotion');
    }

    function homepromotion()
    {
        $promotion = Promotion::all();
        return view('dashboard.manager.homepromotion', compact('promotion'));
    }
    function deletepromotion($id)
    {
        $delete = Promotion::find($id)->delete();
        echo "<script>alert('ลบข้อมูลโปรโมชั่นสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/home'</script>";
    }
    function createareas(Request $request)
    {
        return view('dashboard.manager.createarea');
    }
    public function approveareas(Request $request)
    {
        $areas = Reserve_area::all();
        $countareas = $areas->count();
        return view('dashboard.manager.approveareas', compact('areas', 'countareas'));
    }

    public function addarea($id, $id_area, $id_seller)
    {
        $update = Area::find($id_area)->update([
            'id_seller' => $id_seller
        ]);
        $updateshop = Shop::find($id_seller)->update([
            'id_area' => $id_area
        ]);
        $delete = Reserve_area::find($id)->delete();
        echo "<script>alert('อัพเดตข้อมูลสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/home'</script>";
    }
    public function messageseller(Request $request)
    {
        $idmessage = Chatmanager::select('id_seller')->distinct()->get();
        return view('dashboard.manager.messageseller', compact('idmessage'));
    }
    public function messagesellers($id)
    {
        $idmessage = Chatmanager::select('id_seller')->distinct()->get();
        $message = Chatmanager::where('id_seller', $id)->get();
        return view('dashboard.manager.chatseller',compact('idmessage','message'));
    }
    public function reportpage(Request $request){
        $report = Report::all();
        return view('dashboard.manager.reportpage',compact('report'));
    }

    public function messagechartseller(Request $request){
        if (!$request->message) {
            echo "<script>alert('กรุณาระบุข้อความ')</script>";
            echo "<script>window.location.href='/manager/messageseller/sellerId=$request->id'</script>";
        } else {
            $message = new Chatmanager();
            $message->message = $request->message;
            $message->id_seller = $request->id;
            $message->id_manager = 1;
            $message->status = 'manager';
            $message->save();
            echo "<script>window.location.href='/manager/messageseller/sellerId=$request->id'</script>";


        }
    }

    function createpromotion(Request $request)
    {
        //Validate Inputs
        $request->validate([

            'image' => 'required',
        ], [
            'image.required' => "กรุณาอัพโหลดรูปภาพของคุณ",

        ],);

        //เข้ารหัสรูปภาพ
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img = $name_gen . '.' . $img_ext;
        //อัพโหลดภาพ
        $upload_location = 'images/promotionweb/';
        $full_path = $upload_location . $img;


        $promotion = new Promotion();
        $promotion->image = $img;
        $save = $promotion->save();

        if ($save) {
            $image->move($upload_location, $img);
            echo "<script>alert('ทำการเพิ่มโปรโมชั่นสำเร็จ')</script>";
            echo "<script>window.location.href='/manager/homepromotion'</script>";
        } else {
            return redirect()->back()->with('fail', 'ขออภัยไม่สามารถเพิ่มโปรโมชั่นได้');
        }
    }

    function createarea(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'namearea' => 'required',
            'detail' => 'required',
            'scale' => 'required',
            'rentalfee' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'image' => 'required',
        ], [
            'namearea.required' => "กรุณาป้อนชื่อเเผงร้านค้า",
            'detail.required' => "กรุณาป้อนรายละเอียดเเผงร้านค้า",
            'scale.required' => "กรุณาป้อนขนาดเเผงร้านค้า",
            'rentalfee.required' => "กรุณาป้อนราคาค่าเช่าเเผงร้านค้า",
            'lat.required' => "กรุณาป้อน Latitude",
            'long.required' => "กรุณาป้อน Longitude",
            'image.required' => "กรุณาอัพโหลดรูปภาพของคุณ",

        ],);

        //เข้ารหัสรูปภาพ
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img = $name_gen . '.' . $img_ext;
        //อัพโหลดภาพ
        $upload_location = 'images/areasshop/';
        $full_path = $upload_location . $img;



        $area = new Area();
        $area->namearea = $request->namearea;
        $area->detail = $request->detail;
        $area->scale = $request->scale;
        $area->rentalfee = $request->rentalfee;
        $area->lat = $request->lat;
        $area->long = $request->long;
        $area->image = $img;

        $save = $area->save();

        if ($save) {
            $image->move($upload_location, $img);
            echo "<script>alert('ทำการเพิ่มสำเร็จ')</script>";
            echo "<script>window.location.href='/manager/homepromotion'</script>";
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }
    function cancelpromotionseller($id){
        $update = Promotionseller::find($id)->update([
            "status" => 'no'
        ]);
        echo "<script>alert('ยกเลิกโปรโมชั่นสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/homepromotionseller'</script>";
    }
}
