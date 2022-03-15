<?php

namespace App\Http\Controllers;

use App\Models\Actionclickuser;
use App\Models\Actionuser;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Promotionseller;
use App\Models\Report;
use App\Models\Shop;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class HomepageController extends Controller
{
    public function homepage()
    {

        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->user()->id;
            $allproducts = Product::paginate(12);
            $allpromotions = Promotion::all();
            $allcategories = Categorie::all();

            $checkactionuser = Actionuser::where('id_user', $user_id)->get();
            $countcheckactionuser = $checkactionuser->count();

            $promotionseller = Promotionseller::where('status', 'yes')->get();

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

                return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser', 'product_subcategory', 'promotionseller'));
            } else {
                return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser', 'promotionseller'));
            }
        }

        $allproducts = Product::paginate(12);
        $allpromotions = Promotion::all();
        $allcategories = Categorie::all();

        $promotionseller = Promotionseller::where('status', 'yes')->paginate(3);

        $checkactionuser = Actionuser::where('id_user', 0)->get();
        $countcheckactionuser = $checkactionuser->count();

        if ($countcheckactionuser > 0) {
            $view_max = Actionuser::where('id_user', 0)->max('view');
            $product_max = Actionuser::where('view', $view_max)->get();
            foreach ($product_max as $row) {
                $id_productmax = $row->id_product;
            }
            $subcategory_product = Product::where('id', $id_productmax)->paginate(5);
            foreach ($subcategory_product as $row) {
                $id_subcategory = $row->id_subcategory;
            }
            $product_subcategory = Product::where('id_subcategory', $id_subcategory)->get()->sortByDesc('view');

            return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser', 'product_subcategory', 'promotionseller'));
        } else {
            return view('welcome', compact('allproducts', 'allpromotions', 'allcategories', 'countcheckactionuser', 'promotionseller'));
        }
    }

    public function reportpage(Request $request)
    {
        return view('report');
    }
    public function reportpost(Request $request)
    {
        $request->validate([
            'report' => 'required'

        ], [
            'report.required' => 'กรุณาป้อนข้อความ'
        ]);
        $report = new Report();
        $report->id_user = 0;
        $report->message = $request->report;
        $report->save();
        echo "<script>alert('เเจ้งปัญหาสำเร็จ')</script>";
        echo "<script>window.location.href='/'</script>";
    }

    function promotionseller(Request $request)
    {
        $promotionseller = Promotionseller::where('status', 'yes')->paginate(12);
        return view('promotionseller', compact('promotionseller'));
    }
    function promotionsellershop($id)
    {
        $shop = Shop::where('id_seller', $id)->get();
        foreach ($shop as $row) {
            $id_shop = $row->id;
        }
        echo "<script>window.location.href='/shop/$id_shop'</script>";
    }
}
