<?php

namespace App\Http\Controllers;

use App\Models\Actionclickuser;
use App\Models\Actionuser;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function homepage()
    {

        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->user()->id;
            $allproducts = Product::all();
            $allpromotions = Promotion::all();
            $allcategories = Categorie::all();

            $checkactionuser = Actionuser::where('id_user', $user_id)->get();
            $countcheckactionuser = $checkactionuser->count();

            if ($countcheckactionuser > 0) {

                $view_max = Actionuser::where('id_user', $user_id)->max('view');
                $product_max = Actionuser::where('view', $view_max)->get();
                foreach ($product_max as $row) {
                    $id_productmax = $row->id_product;
                }
                $subcategory_product = Product::where('id', $id_productmax)->get();
                foreach ($subcategory_product as $row) {
                    $id_subcategory = $row->id_subcategory;
                }
                $product_subcategory = Product::where('id_subcategory', $id_subcategory)->get()->sortByDesc('view');

                return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser', 'product_subcategory'));
            } else {
                return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser'));
            }
        }

        $allproducts = Product::all();
        $allpromotions = Promotion::all();
        $allcategories = Categorie::all();

        $checkactionuser = Actionuser::where('id_user', 0)->get();
        $countcheckactionuser = $checkactionuser->count();

        if ($countcheckactionuser > 0) {
            $view_max = Actionuser::where('id_user', 0)->max('view');
            $product_max = Actionuser::where('view', $view_max)->get();
            foreach ($product_max as $row) {
                $id_productmax = $row->id_product;
            }
            $subcategory_product = Product::where('id', $id_productmax)->get();
            foreach ($subcategory_product as $row) {
                $id_subcategory = $row->id_subcategory;
            }
            $product_subcategory = Product::where('id_subcategory', $id_subcategory)->get()->sortByDesc('view');

            return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser', 'product_subcategory'));
        } else {
            return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser'));
        }
    }
}
