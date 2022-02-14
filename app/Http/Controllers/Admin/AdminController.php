<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function home(Request $request){
        $manager = Manager::all();
        $countmanager = $manager->count();
        $seller = Seller::all();
        $countseller = $seller->count();
        $user = User::all();
        $countuser = $user->count();
        $shop = Shop::all();
        $countshop = $shop->count();
        $product = Product::all();
        $countproduct = $product->count();

        return view('dashboard.admin.home',compact('countmanager','countseller','countuser','countshop','countproduct'));
    }
    function check(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:8|max:30',
        ]);

        $creds = $request->only('email','password');
        if( Auth::guard('admin')->attempt($creds) ){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
    }

    function createmanager(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:30',
            'cpassword' => 'required|min:8|max:30|same:password',
        ], [
            'firstname.required' => "กรุณาป้อนชื่อ",
            'lastname.required' => "กรุณาป้อนนามสกุล",
            'email.required' => "กรุณาป้อน Email",
            'password.required' => "กรุณาป้อนรหัสผ่าน",
            'cpassword.required' => "กรุณาป้อนรหัสผ่าน",
            'cpassword.same:password'=>"รหัสผ่านไม่ตรงกัน",
            'password.min' => "กรุณาใส่รหัสมากกว่า 8 ตัวอักษร",
            'email.unique' => "มี email นี้เเล้วอยู่ในระบบเเล้ว"

        ],);

        $manager = new Manager();
        $manager->firstname = $request->firstname;
        $manager->lastname = $request->lastname;
        $manager->email = $request->email;
        $manager->password = \Hash::make($request->password);
        $save = $manager->save();

        if ($save) {
            return redirect()->back()->with('success', 'สร้างบัญชีผู้จัดการสำเร็จ !!!');
        } else {
            return redirect()->back()->with('fail', 'ขออภัยไม่สามารถสร้างบัญชีผู้จัดการ');
        }
    }

    function editmanager(Request $request){
        $manager = Manager::all();
        return view('dashboard.admin.editmanagers',compact('manager'));
    }
    function editseller(Request $request){
        $seller = Seller::all();
        return view('dashboard.admin.editseller',compact('seller'));
    }
    function edituser(Request $request){
        $user = User::all();
        return view('dashboard.admin.edituser',compact('user'));
    }
    function editshop(Request $request){
        $shop = Shop::all();
        return view('dashboard.admin.editshop',compact('shop'));
    }
    function editproduct(Request $request){
        $product = Product::all();
        return view('dashboard.admin.editproduct',compact('product'));
    }

    public function deletemanager($id){
        $delete=Manager::find($id)->delete();
        echo "<script>alert('ลบข้อมูลบัญชีผู้จัดการสำเร็จ')</script>";
        echo "<script>window.location.href='/admin/home'</script>";

    }
    public function deleteseller($id){
        $delete=Seller::find($id)->delete();
        echo "<script>alert('ลบข้อมูลบัญชีร้านค้าสำเร็จ')</script>";
        echo "<script>window.location.href='/admin/home'</script>";

    }
    public function deleteuser($id){
        $delete=User::find($id)->delete();
        echo "<script>alert('ลบข้อมูลบัญชีสมาชิกสำเร็จ')</script>";
        echo "<script>window.location.href='/admin/home'</script>";

    }
    public function deleteshop($id){
        $delete=Shop::find($id)->delete();
        echo "<script>alert('ลบข้อมูลร้านค้าสำเร็จ')</script>";
        echo "<script>window.location.href='/admin/home'</script>";

    }



    function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
