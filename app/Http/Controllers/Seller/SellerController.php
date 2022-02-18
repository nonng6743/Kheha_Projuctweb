<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Categorie;
use App\Models\Login;
use App\Models\Product;
use App\Models\Reserve_area;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    function home(Request $request)
    {
        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        return view('dashboard.seller.home', compact('counts'));
    }

    function homeshop(Request $request)
    {
        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        return view('dashboard.seller.homeshop', compact('counts','shops'));
    }

    function homecreateproduct(Request $request)
    {
        $id_seller = Auth::guard('seller')->user()->id;
        $subcategory = Subcategorie::all();
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        return view('dashboard.seller.createproduct', compact('counts'), compact('subcategory'));
    }

    function homecreateshop(Request $request)
    {
        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        $categories = Categorie::all();
            return view('dashboard.seller.createshop', compact('counts'), compact('categories'));
    }

    function homeproducts(Request $request)
    {
        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        foreach ($shops as $shop) {
            $id_shop = $shop->id;
        }
        $products = Product::where('id_shop', $id_shop)->paginate(5);
        return view('dashboard.seller.homeproducts', compact('counts'), compact('products'));
    }

    public function addarea(Request $request)
    {
        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        $areas = Area::where('id_seller', 0)->get();
        $countareas = $areas->count();
        $check_reservearea = Reserve_area::where('id_seller', $id_seller)->get();
        $countcheck_reservearea = $check_reservearea->count();

        $check_area = Area::where('id_seller', $id_seller)->get();
        $countcheck_area = $check_area->count();
        return view('dashboard.seller.addarea', compact('counts', 'areas','countareas', 'countcheck_reservearea','countcheck_area'));
    }

    public function create(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:sellers',
            'password' => 'required|min:8|max:30',
            'cpassword' => 'required|min:8|max:30|same:password',
            'phone' => 'required|numeric|digits:10',
            'gender' => 'required',
            'image' => 'required|',
            'birthdey' => 'required',
            'IDCard' => 'required',
            'phone' => 'required',


        ], [
            'firstname.required' => "กรุณาป้อนชื่อ",
            'lastname.required' => "กรุณาป้อนนามสกุล",
            'email.required' => "กรุณาป้อน Email",
            'password.required' => "กรุณาป้อนรหัสผ่าน",
            'cpassword.required' => "กรุณาป้อนรหัสผ่าน",
            'cpassword.same:password' => "รหัสผ่านไม่ตรงกัน",
            'phone.required' => "กรุณาป้อนเบอร์โทรศัทพ์ของคุณ",
            'IDCard.required' => "กรุณาป้อนรหัสบัตรประชาชนของคุณ",
            'birthdey.required' => "กรุณาระบุวันเกิดของท่าน",
            'gender.required' => "กรุณาเลือกเพศของคุณ",
            'password.min' => "กรุณาใส่รหัสมากกว่า 8 ตัวอักษร",
            'email.unique' => "มี email นี้เเล้วอยู่ในระบบเเล้ว",
            'image.required' => "กรุณาอัพโหลดรูปภาพของคุณ",

        ],);

        //เข้ารหัสรูปภาพ
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img = $name_gen . '.' . $img_ext;
        //อัพโหลดภาพ
        $upload_location = 'images/profileseller/';
        $full_path = $upload_location . $img;

        $seller = new Seller();
        $seller->firstname = $request->firstname;
        $seller->lastname = $request->lastname;
        $seller->phone = $request->phone;
        $seller->idcard = $request->IDCard;
        $seller->birthdey = $request->birthdey;
        $seller->gender = $request->gender;
        $seller->image = $img;
        $seller->email = $request->email;
        $seller->password = \Hash::make($request->password);
        $save = $seller->save();

        if ($save) {
            $image->move($upload_location, $img);
            echo "<script>alert('เพิ่มข้อมูลสินค้าสำเร็จ')</script>";
            echo "<script>window.location.href='/seller/homeproducts'</script>";
        } else {
            return redirect()->back()->with('fail', 'เกิดข้อผิดพลาดกรุณาสมัครสมาชิกผู้ขายอีกครั้ง');
        }
    }

    function check(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'email' => 'required|email|exists:sellers,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'This email is not exists in seller table'
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('seller')->attempt($creds)) {
            $login = new Login();
            $login->typeuser = 'seller';
            $login->save();
            return redirect()->route('seller.home');
        } else {
            return redirect()->route('seller.login')->with('fail', 'Incorrect Credentials');
        }
    }

    function logout()
    {
        Auth::guard('seller')->logout();
        return redirect('/');
    }

    function createshop(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'nameshop' => 'required',
            'category_type' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'image' => 'required',
        ], [
            'nameshop.required' => "กรุณาป้อนชื่อ",
            'category_type.required' => "กรุณาเลือกประเภท",
            'email.required' => "กรุณาป้อน Email",
            'lat.required' => "กรุณาป้อน Latitude",
            'long.required' => "กรุณาป้อน Longitude",
            'image.required' => "กรุณาอัพโหลดรูปภาพของคุณ",

        ],);

        //เข้ารหัสรูปภาพ
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img = $name_gen . '.' . $img_ext;
        //อัพโหลดภาพ
        $upload_location = 'images/shops_seller/';
        $full_path = $upload_location . $img;

        $id_seller = Auth::guard('seller')->user()->id;

        $shop = new Shop();
        $shop->nameshop = $request->nameshop;
        $shop->category_type = $request->category_type;
        $shop->lat = $request->lat;
        $shop->long = $request->long;
        $shop->image = $img;
        $shop->id_seller = $id_seller;
        $save = $shop->save();

        if ($save) {
            $image->move($upload_location, $img);
            echo "<script>alert('สร้างร้านค้าสำเร็จ')</script>";
            echo "<script>window.location.href='/seller/homeproducts'</script>";
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }

    function createproduct(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'nameproduct' => 'required',
            'detail' => 'required',
            'price' => 'required',
            'image' => 'required',
        ], [
            'nameproduct.required' => "กรุณาป้อนชื่อสินค้า",
            'detail.required' => "กรุณาใส่รายละเอียด",
            'price.required' => "กรุณาใส่ราคาสินค้า",
            'image.required' => "กรุณาอัพโหลดรูปภาพของคุณ",

        ],);

        //เข้ารหัสรูปภาพ
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img = $name_gen . '.' . $img_ext;
        //อัพโหลดภาพ
        $upload_location = 'images/products_seller/';
        $full_path = $upload_location . $img;

        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();

        foreach ($shops as $shop) {

            $id_shop = $shop->id;
        }

        $product = new Product();
        $product->nameproduct = $request->nameproduct;
        $product->detail = $request->detail;
        $product->id_subcategory = $request->id_subcategory;
        $product->price = $request->price;
        $product->image = $img;
        $product->id_shop = $id_shop;
        $save = $product->save();

        if ($save) {
            $image->move($upload_location, $img);
            echo "<script>alert('เพิ่มข้อมูลสินค้าสำเร็จ')</script>";
            echo "<script>window.location.href='/seller/homeproducts'</script>";
        } else {
            return redirect()->back()->with('fail', 'ขออภัยไม่สามารถเพิ่มสินค้าได้');
        }
    }

    public function editproduct($id)
    {
        $product = Product::find($id);
        $id_seller = Auth::guard('seller')->user()->id;
        $shops = Shop::where('id_seller', $id_seller)->get();
        $counts = $shops->count();
        return view('dashboard.seller.editproducts', compact('counts'), compact('product'));
    }

    public function updateproduct(Request  $request, $id)
    {
        $request->validate([
            'nameproduct' => 'required',
            'detail' => 'required',
            'price' => 'required',

        ], [
            'nameproduct.required' => "กรุณาป้อนชื่อสินค้า",
            'detail.required' => "กรุณาใส่รายละเอียด",
            'price.required' => "กรุณาใส่ราคาสินค้า",


        ],);
        $image = $request->file('image');

        if ($image) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img = $name_gen . '.' . $img_ext;
            //อัพโหลดภาพ
            $upload_location = 'images/products_seller/';
            $full_path = $upload_location . $img;


            $update = Product::find($id)->update([
                'nameproduct' => $request->nameproduct,
                'detail' => $request->detail,
                'price' => $request->price,
                'image' => $img,
            ]);

            $old_image = $request->old_image;
            unlink('images/products_seller/' . $old_image);
            $image->move($upload_location, $img);

            echo "<script>alert('อัพเดตข้อมูลสินค้าสำเร็จ')</script>";
            echo "<script>window.location.href='/seller/homeproducts'</script>";
        } else {
            $update = Product::find($id)->update([
                'nameproduct' => $request->nameproduct,
                'detail' => $request->detail,
                'price' => $request->price,
            ]);
            echo "<script>alert('อัพเดตข้อมูลสินค้าสำเร็จ')</script>";
            echo "<script>window.location.href='/seller/homeproducts'</script>";
        }
    }

    public function deleteproducts($id)
    {
        $img = Product::find($id)->image;
        unlink('images/products_seller/' . $img);

        $delete = Product::find($id)->delete();
        echo "<script>alert('ลบข้อมูลสินค้าสำเร็จ')</script>";
        echo "<script>window.location.href='/seller/homeproducts'</script>";
    }

    public function area_add($id){
        $id_seller = Auth::guard('seller')->user()->id;
        $reserve_areas = new Reserve_area();
        $reserve_areas->id_seller = $id_seller;
        $reserve_areas->id_area = $id;
        $save = $reserve_areas->save();

        if ($save) {
            echo "<script>alert('จองเเผงรร้านค้าสำเร็จ')</script>";
            echo "<script>window.location.href='/seller/home'</script>";
        } else {
            return redirect()->back()->with('fail', 'ขออภัยไม่สามารถเพิ่มสินค้าได้');
        }
    }
}
