<?php

namespace App\Http\Controllers;

use App\Models\Actionclickuser;
use App\Models\Actionuser;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Subcategorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    public function productname($id)
    {
        $product = Product::find($id);
        $id_subcategory = $product->id_subcategory;
        $subproduct = Product::where('id_subcategory',$id_subcategory)->get();

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


                return view('pageproduct', compact('product','counts','subproduct'));
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

            return view('pageproduct', compact('product','counts','subproduct'));
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

            return view('pageproduct', compact('product','counts','subproduct'));
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

        return view('pageproduct', compact('product','counts','subproduct'));
    }

    public function productCategoryname($name){
        $allcategories = Categorie::all();
        $category = Categorie::where('namecategory',$name)->get();
        foreach ($category as $row){
            $id_category = $row->id;
        }
        $subcategory = Subcategorie::where('id_category', $id_category)->get();
        return view('productCategory',compact('allcategories','subcategory','name'));
    }
    public function productsubcategoryname($name){
        $allcategories = Categorie::all();
        $subcategory_name = Subcategorie::where('namesubcategory', $name)->get();
        foreach($subcategory_name as $row){
            $id_subcategory = $row->id;
            $id_category = $row->id_category;
        }
        $category = Categorie::where('id',$id_category)->get();
        foreach ($category as $row){
            $namecategory = $row->namecategory;
        }

        $subcategory = Subcategorie::where('id_category', $id_category)->get();
        $product_type = Product::where('id_subcategory', $id_subcategory)->get();
        return view('productsubcategory',compact('allcategories','product_type','subcategory','namecategory'));
    }

    public function searchproduct($name){
        $search= Product::where('nameproduct', 'LIKE', "%{$name}%") ->get();
        $countsearch = $search->count();
        return view('searchproduct',compact('name','search','countsearch'));
    }

    public function searchproductname(Request $request){
        echo "<script>window.location.href='/searchproduct/$request->namesearch'</script>";
    }



}
