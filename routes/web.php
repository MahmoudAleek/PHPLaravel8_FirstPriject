<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiPicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChangePassController;

use App\Console\Commands\SendEmail;
use Illuminate\Console\Command;


use App\Models\User;
use App\Models\Brand;
use App\Models\Multipic;

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


// Route::get('/',function(){
//     // $newEmail = new SendEmail();
//     // $newEmail->run();

//     return 'test ano baaakaaa';
//     Artisan::command('user:bla {id}',function($id){
//         return 'true';
//        return $this->info($id);
//     });
//     //return 'true';
// });


Route::get('/', function () {
    $brands = Brand::all();
    $about = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home',compact('brands','about','images'));
});


route::get('/home',[HomeController::class,'index'])->name('home');

route::get('/search',[CategoryController::class , 'search_Method'])->name('sasa_search');
route::post('/search',[CategoryController::class , 'search_Method2'])->name('sasa_search2');
route::get('/search/{id}',[CategoryController::class , 'search_Method3'])->name('sasa_search3');


// All Category
Route::get('/category/all',[CategoryController::class , 'AllCat'])->name('all.category');

Route::post('/category/add',[CategoryController::class , 'AddCat'])->name('store.category');

Route::get('category/edit/{id}',[CategoryController::class , 'Edit'])->name('edit.category');
Route::post('category/update/{id}',[CategoryController::class , 'Update'])->name('update.category');
Route::get('category/delete/{id}',[CategoryController::class , 'SoftDelete'])->name('delete.category');
Route::get('category/restore/{id}',[CategoryController::class , 'Restore'])->name('restore.category');
Route::get('category/pdelete/{id}',[CategoryController::class , 'Pdelete'])->name('pdelete.category');


// All Brand

Route::get('/brand/all',[BrandController::class , 'AllBrand'])->name('all.brand');
Route::post('/brand/store',[BrandController::class , 'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}',[BrandController::class , 'Edit'])->name('edit.brand');
Route::post('brand/update/{id}',[BrandController::class ,'Update'])->name('update.brand');
Route::get('/brand/delete/{id}',[BrandController::class , 'Delete'])->name('delete.brand');

// For Multi Pic

Route::get('/multi/images',[MultiPicController::class , 'Multi_Images'])->name('multi.image');
Route::post('/multi/add',[MultiPicController::class ,'StoreImages'])->name('store.images');


//// All Home Routes

//* Slider Section  *//
Route::get('home/slider',[HomeController::class , 'HomeSlider'])->name('home.slider');
Route::get('add/slider',[HomeController::class , 'AddSlider'])->name('add.slider');
Route::post('sotre/slider',[HomeController::Class , 'StoreSlider'])->name('store.slider');
Route::get('slider/edit/{id}',[HomeController::class ,'EditSlider'])->name('edit.slider');
Route::post('slider/update/{id}',[HomeController::Class , 'UpdateSlider'])->name('update.slider');
Route::get('slider/delete/{id}',[HomeController::class ,'DeleteSlider'])->name('delete.slider');



/* About Section */
Route::get('home/about',[HomeAboutController::class,'HomeAbout'])->name('home.about');
Route::get('add/about',[HomeAboutController::class,'AddAbout'])->name('add.about');
Route::post('store/about',[HomeAboutController::class,'StoreAbout'])->name('store.about');
Route::get('about/edit/{id}',[HomeAboutController::class,'EditAbout'])->name('edit.about');
Route::post('about/update/{id}',[HomeAboutController::class,'UpdateAbout'])->name('update.about');
Route::get('about/delete/{id}',[HomeAboutController::class,'DeleteAbout'])->name('delete.about');



/* About Section */
Route::get('/home/service',[HomeController::class , 'HomeService'])->name('home.service');
Route::get('add/service',[HomeController::class,'AddService'])->name('add.service');
Route::post('store/service',[HomeController::class,'StoreService'])->name('store.service');


//// Portfolio /////
Route::get('/portfolio',[PortfolioController::class , 'index'])->name('portfolio');


//////// Admin Contact Page Routes /////// 
Route::get('/admin/contact',[ContactController::class , 'AdminContact'])->name('admin.contact')->middleware('auth');
Route::get('/admin/contact/create',[ContactController::class , 'AdminAddContact'])->name('add.contact');
Route::post('/admin/contact/store',[ContactController::class , 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/contact/edit/{id}',[ContactController::class , 'EditContact'])->name('edit.contact');
Route::post('/admin/contact/update/{id}',[ContactController::class , 'UpdateContact'])->name('update.contact');
Route::get('/admin/contact/delete/{id}',[ContactController::class , 'DeleteContact'])->name('delete.contact');



///////// Home Contact Page Routes /////////
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/send-message',[ContactController::class,'ContactForm'])->name('contact.form');
Route::get('/contact/messages',[ContactController::Class,'ContactMessages'])->name('contact.message');
Route::get('/contact/messages/delete/{id}',[ContactController::Class,'DeleteContactMessage'])->name('delete.contact.message');


////// Change Password and User Profile Routes /////////
Route::get('user/password',[ChangePassController::class,'CPassword'])->name('change.password');
Route::post('password/update',[ChangePassController::class,'Update_Password'])->name('update.password');



////// Profile User Routes 
Route::get('user/profile',[ChangePassController::class,'EProfile'])->name('profile.page');
Route::post('user/profile/update',[ChangePassController::class,'UProfile'])->name('update.profile');




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

   // $users = User::all();

    return view('admin.index');
})->name('dashboard');



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');




/////// For User 

Route::get('user/logout',[UserController::class ,'Logout'])->name('user.logout');

