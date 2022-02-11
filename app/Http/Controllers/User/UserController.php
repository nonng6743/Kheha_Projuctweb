<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
        $user->role= "user";
        $user->image= "";
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'You are now registered successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
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
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail','Incorrect credentials');
        }
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
