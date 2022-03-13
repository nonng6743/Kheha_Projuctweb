<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Follow;
use App\Models\Login;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function home(Request $request){
        $user_id = Auth::guard('web')->user()->id;
        $follow = Follow::where('id_user',$user_id)->get();
        $countfollow = $follow->count();
        return view('dashboard.user.home',compact('countfollow'));
    }
    function usermessage(Request $request){
        $user_id = Auth::guard('web')->user()->id;
        $idmessage = Chat::select('id_shop')->distinct()->where('id_user', $user_id)->get();
        return view('dashboard.user.homesellermessage',compact('idmessage'))->render();
    }
    function messageseller($id){
        $user_id = Auth::guard('web')->user()->id;
        $idmessage = Chat::select('id_shop')->distinct()->where('id_user', $user_id)->get();
        $message = Chat::where('id_user', $user_id)->where('id_shop', $id)->get();
        return view('dashboard.user.sellermessage',compact('idmessage','message'));
    }

    function messagechatseller(Request $request){
        $user_id = Auth::guard('web')->user()->id;
        if (!$request->message) {
            echo "<script>alert('กรุณาระบุข้อความ')</script>";
            echo "<script>window.location.href='/user/messageseller/userId=$request->id'</script>";
        } else {
            $message = new Chat();
            $message->id_user = $user_id;
            $message->id_shop = $request->id;
            $message->message = $request->message;
            $message->status = 'user';
            $message->save();
            echo "<script>window.location.href='/user/messageseller/userId=$request->id'</script>";
        }
    }
    function create(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:30',
            'cpassword' => 'required|min:8|max:30|same:password',
            'phone' => 'required|numeric|digits:10',
            'gender' => 'required',

        ], [
            'firstname.required' => "กรุณาป้อนชื่อ",
            'lastname.required' => "กรุณาป้อนนามสกุล",
            'email.required' => "กรุณาป้อน Email",
            'password.required' => "กรุณาป้อนรหัสผ่าน",
            'cpassword.required' => "กรุณาป้อนรหัสผ่าน",
            'cpassword.same:password'=>"รหัสผ่านไม่ตรงกัน",
            'phone.required' => "กรุณาป้อนเบอร์โทรศัทพ์ของคุณ",
            'gender.required' => "กรุณาเลือกเพศของคุณ",
            'password.min' => "กรุณาใส่รหัสมากกว่า 8 ตัวอักษร",
            'email.unique' => "มี email นี้เเล้วอยู่ในระบบเเล้ว"

        ],);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->image= "";
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            echo "<script>alert('สมัครสมาชิกสำเร็จ')</script>";
            echo "<script>window.location.href='/user/home'</script>";
        } else {
            return redirect()->back()->with('fail', 'เกิดข้อผิดพลาดกรุณาสมัครสมาชิกใหม่อีกครั้ง !!');
        }
    }


    function check(Request $request){
        //Validate inputs
        $request->validate([
           'email'=>'required|email|exists:users,email',
           'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists on users table'
        ]);

        $creds = $request->only('email','password');
        if( Auth::guard('web')->attempt($creds) ){
            $login = new Login();
            $login->typeuser = 'user';
            $login->save();
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail','การเข้าสู้ระบบเกิดข้อผิดพลาด กรุณาเข้าสู่ระบบอีกครั้ง');
        }
    }



    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
