<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Product;
use App\Models\User;
use App\Models\Seller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //
    public function testapi()
    {
      $product = Product::all();
      return  response()->json(
        $product
      );
    }

    public function loginuser(Request $request){
        $creds = $request->only('email','password');
        if( Auth::guard('web')->attempt($creds) ){
            $user = User::where('email', $request->email)->get();
           return response()->json($user);
        }else{
           	echo "false";
        }

    }
    public function index(Request $request){
        return '555';
    }

   public function loginseller(Request $request){
        $creds = $request->only('email','password');
        if( Auth::guard('seller')->attempt($creds) ){
            $seller = Seller::where('email', $request->email)->get();
           return response()->json($seller);
        }else{
           	 	echo "false";
        }

    }
    public function addusers(Request $request)
    {
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->image= "profile.jpg";
        $user->password = \Hash::make($request->password);
        $save = $user->save();
        if($save){
           echo "true";
        }
        else{
           echo "false";
        }

    }


     public function addseller(Request $request)
    {
        $seller = new Seller();
        $seller->firstname = $request->firstname;
        $seller->lastname = $request->lastname;
        $seller->idcard = $request->idcard;
        $seller->phone = $request->phone;
        $seller->gender = $request->gender;
        $seller->birthday = $request->birthday;
        $seller->role = "noseller";
        $seller->email = $request->email;
        $seller->image=  $request->image;
        $seller->password = \Hash::make($request->password);
        $save = $seller->save();
        if($save){
           echo "true";
        }
        else{
           echo "false";
        }

    }
     public function loginmanager(Request $request){
        $creds = $request->only('email','password');
        if( Auth::guard('manager')->attempt($creds) ){
            $manager = Manager::where('email', $request->email)->get();
           return response()->json($manager);
        }else{
           	 	echo "false";
        }

    }

}

?>

