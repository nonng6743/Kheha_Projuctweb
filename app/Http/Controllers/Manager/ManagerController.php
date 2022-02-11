<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Manager;
use App\Models\Promotion;
use App\Models\Seller;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    function check(Request $request){
        $request->validate([
            'email'=>'required|email|exists:managers,email',
            'password'=>'required|min:8|max:30',
        ]);

        $creds = $request->only('email','password');
        if( Auth::guard('manager')->attempt($creds) ){
            return redirect()->route('manager.home');
        }else{
            return redirect()->route('manager.login')->with('fail','Email หรือ Password ผิดกรุณาใส่รหัสผ่านใหม่');
        }
    }

    public function editseller(Request $request)
    {
        $user_seller = Seller::where('status', 'noseller')->get();
        return view('dashboard.manager.editseller',compact('user_seller'));
    }

    public function updateseller($id)
    {
        $update = Seller::find($id)->update([
            'status' => "seller"
        ]);
        echo "<script>alert('อัพเดตข้อมูลสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/home'</script>";
    }

    public function deleteseller($id){
        $img = Seller::find($id)->image;
        unlink('images/profileseller/'.$img);

        $delete=Seller::find($id)->delete();
        echo "<script>alert('ลบข้อมูลสินค้าสำเร็จ')</script>";
        echo "<script>window.location.href='/manager/home'</script>";

    }

    function logout(){
        Auth::guard('manager')->logout();
        return redirect('/');
    }

    function homecreatepromotion(){
        return view('dashboard.manager.createpromotion');
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
            return redirect()->back()->with('success', 'ทำการเพิ่มโปรโมชั่นสำเร็จ');
        } else {
            return redirect()->back()->with('fail', 'ขออภัยไม่สามารถเพิ่มโปรโมชั่นได้');
        }
    }
}
