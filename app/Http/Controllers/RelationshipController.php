<?php

namespace App\Http\Controllers;

use App\Models\Actionclickuser;
use App\Models\Actionuser;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RelationshipController extends Controller
{
    public function productname($id)
    {
        $product = Product::find($id);
        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->user()->id;
            $actionclickusers = new Actionclickuser();
            $actionclickusers->id_user = $user_id;
            $actionclickusers->id_products = $id;
            $save = $actionclickusers->save();

            $id_product = $id;
            $products = Actionclickuser::where('id_products', $id_product)->get();
            $counts = $products->count();



            $actionusers = Actionuser::where('id_user', $user_id)->where('id_product', $id)->get();
            $countactionuser = $actionusers->count();
            if ($countactionuser === 0) {
                $checkactionuser = Actionclickuser::where('id_user', $user_id)->where('id_products', $id)->get();
                $countcheckactionuser = $checkactionuser->count();

                $inactionusers = new Actionuser();
                $inactionusers->id_user = $user_id;
                $inactionusers->id_product = $id;
                $inactionusers->view = $countcheckactionuser;
                $inactionusers->save();


                return view('pageproduct', compact('product'), compact('counts'));
            }
            foreach ($actionusers  as $user) {
                $iduser_actionuser = $user->id;
            }
            $checkactionuser = Actionclickuser::where('id_user', $user_id)->where('id_products', $id)->get();
            $countcheckactionuser = $checkactionuser->count();

            $updateactionuser = Actionuser::find($iduser_actionuser)->update([
                'view' => $countcheckactionuser,
            ]);

            $updateviewproduct = Product::find($id)->update([
                'view' => $counts
            ]);

            return view('pageproduct', compact('product'), compact('counts'));
        }

        $user_id = 0;
        $actionclickusers = new Actionclickuser();
        $actionclickusers->id_user = $user_id;
        $actionclickusers->id_products = $id;
        $save = $actionclickusers->save();

        $id_product = $id;
        $products = Actionclickuser::where('id_products', $id_product)->get();
        $counts = $products->count();


        $actionusers = Actionuser::where('id_user', $user_id)->where('id_product', $id)->get();
        $countactionuser = $actionusers->count();
        if ($countactionuser === 0) {
            $checkactionuser = Actionclickuser::where('id_user', $user_id)->where('id_products', $id)->get();
            $countcheckactionuser = $checkactionuser->count();

            $inactionusers = new Actionuser();
            $inactionusers->id_user = $user_id;
            $inactionusers->id_product = $id;
            $inactionusers->view = $countcheckactionuser;
            $inactionusers->save();

            return view('pageproduct', compact('product'), compact('counts'));
        }
        foreach ($actionusers  as $user) {
            $iduser_actionuser = $user->id;
        }
        $checkactionuser = Actionclickuser::where('id_user', $user_id)->where('id_products', $id)->get();
        $countcheckactionuser = $checkactionuser->count();

        $updateactionuser = Actionuser::find($iduser_actionuser)->update([
            'view' => $countcheckactionuser,
        ]);

        $updateviewproduct = Product::find($id)->update([
            'view' => $counts
        ]);

        return view('pageproduct', compact('product'), compact('counts'));
    }
}
