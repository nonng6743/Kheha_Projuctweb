<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Manager\ManagerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');
Route::get('/productpage/{id}', [RelationshipController::class, 'productname']);
Route::get('/productCategory/{name}', [RelationshipController::class, 'productCategoryname']);
Route::get('/productsubcategory/{name}', [RelationshipController::class, 'productsubcategoryname']);
Route::get('/searchproduct/{name}', [RelationshipController::class, 'searchproduct']);
Route::get('/productall', [RelationshipController::class, 'productall']);
Route::post('/searchproduct', [RelationshipController::class, 'searchproductname'])->name('searchname');



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.user.home')->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::get('/home', [AdminController::class, 'home'])->name('home');
        Route::view('/createmanager', 'dashboard.admin.createmanager')->name('createmanager');
        Route::get('/editmanager', [AdminController::class, 'editmanager'])->name('editmanager');
        Route::get('/deletemanager/{id}',[AdminController::class,'deletemanager']);
        Route::get('/editseller', [AdminController::class, 'editseller'])->name('editseller');
        Route::get('/deleteseller/{id}',[AdminController::class,'deleteseller']);
        Route::get('/edituser', [AdminController::class, 'edituser'])->name('edituser');
        Route::get('/deleteuser/{id}',[AdminController::class,'deleteuser']);
        Route::get('/editshop', [AdminController::class, 'editshop'])->name('editshop');
        Route::get('/deleteshop/{id}',[AdminController::class,'deleteshop']);
        Route::get('/editproduct', [AdminController::class, 'editproduct'])->name('editproduct');
        Route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

        Route::post('/createmanager', [AdminController::class, 'createmanager'])->name('createmanager');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    });
});

Route::prefix('seller')->name('seller.')->group(function () {

    Route::middleware(['guest:seller', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.seller.login')->name('login');
        Route::view('/register', 'dashboard.seller.register')->name('register');
        Route::post('/create', [SellerController::class, 'create'])->name('create');
        Route::post('/check', [SellerController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:seller', 'PreventBackHistory'])->group(function () {
        Route::get('/home', [SellerController::class, 'home'])->name('home');
        Route::get('/homeshop', [SellerController::class, 'homeshop'])->name('homeshop');
        Route::get('/createproduct', [SellerController::class, 'homecreateproduct'])->name('createproduct');
        Route::get('/createshop', [SellerController::class, 'homecreateshop'])->name('createshop');
        Route::get('/homeproducts', [SellerController::class, 'homeproducts'])->name('products');
        Route::get('/editproduct/{id}', [SellerController::class, 'editproduct']);
        Route::get('/deleteproducts/{id}',[SellerController::class,'deleteproducts']);
        Route::get('/addarea', [SellerController::class, 'addarea'])->name('addarea');
        Route::get('/area_add/{id}', [SellerController::class, 'area_add'])->name('area_add');


        Route::post('/createshop', [SellerController::class, 'createshop'])->name('createshop');
        Route::post('/createproduct', [SellerController::class, 'createproduct'])->name('createproduct');
        Route::post('/logout', [SellerController::class, 'logout'])->name('logout');
        Route::post('/updateproduct/{id}', [SellerController::class, 'updateproduct']);
    });
});

Route::prefix('manager')->name('manager.')->group(function () {

    Route::middleware(['guest:manager', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.manager.login')->name('login');
        Route::post('/check', [ManagerController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:manager', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.manager.home')->name('home');
        Route::get('/homecreatepromotion', [ManagerController::class, 'homecreatepromotion'])->name('homecreatepromotion');
        Route::get('/editseller', [ManagerController::class, 'editseller'])->name('editseller');
        Route::get('/editseller/{id}', [ManagerController::class, 'updateseller']);
        Route::get('/deleteseller/{id}',[ManagerController::class,'deleteseller']);
        Route::get('/homepromotion', [ManagerController::class, 'homepromotion'])->name('homepromotion');
        Route::get('/deletepromotion/{id}',[ManagerController::class,'deletepromotion']);
        Route::get('/createareas', [ManagerController::class, 'createareas'])->name('createareas');
        Route::get('/approveareas', [ManagerController::class, 'approveareas'])->name('approveareas');
        Route::get('/addarea/{id}/{id_area}/{id_seller}',[ManagerController::class,'addarea']);

        Route::post('/createarea', [ManagerController::class, 'createarea'])->name('createarea');
        Route::post('/homecreatepromotion', [ManagerController::class, 'createpromotion'])->name('createpromotion');
        Route::post('/logout', [ManagerController::class, 'logout'])->name('logout');


    });
});
