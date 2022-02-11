<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

use App\Models\Manager;
use App\Models\Promotion;
use App\Models\Seller;
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
            return redirect()->route('manager.home');
        } else {
            return redirect()->route('manager.login')->with('fail', 'Email หรือ Password ผิดกรุณาใส่รหัสผ่านใหม่');
        }
    }

    public function editseller(Request $request)
    {
        $user_seller = Seller::where('status', 'noseller')->get();
        return view('dashboard.manager.editseller', compact('user_seller'));
    }

    public function updateseller($id)
    {
        $update = Seller::find($id)->update([
            'status' => "seller"
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

        $seller_id = Auth::guard('manager')->user()->id;

        $area = new Area();
        $area->namearea = $request->namearea;
        $area->detail = $request->detail;
        $area->scale = $request->scale;
        $area->rentalfee = $request->rentalfee;
        $area->lat = $request->lat;
        $area->long = $request->long;
        $area->image = $img;
        $area->id_seller = $seller_id;
        $save = $area->save();

        if ($save) {
            $image->move($upload_location, $img);
            echo "<script>alert('ทำการเพิ่มสำเร็จ')</script>";
            echo "<script>window.location.href='/manager/homepromotion'</script>";
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }
}
