<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

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

    public function add(Request $request)
    {
        $creds = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($creds)) {
            $user = User::where('email', $request->email)->get();
            return response()->json($user);
        } else {
            return response()->json(['message' => 'login fail']);
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
        $user->image= "";
        $user->password = \Hash::make($request->password);
        $save = $user->save();
        if($save){
            return response()->json(['message' => "create success"  ]);
        }
        else{
            return response()->json(['message' => "carete faill !! " ]);
        }

    }
}
