<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BrandController;
use App\Models\Brand;
use Illuminate\Support\Carbon;

use Image;

class BrandController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }


    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    Public function StoreBrand(Request $request){

        $ValidateBrand = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required'
        ],[
            'brand_name.required' => 'Please Insert Brand Name',
            'brand_name.unique' => 'This Name already token',
            'brand_name.min' => 'please Insert More Than 4 Characters',
            'brand_image.required' => 'Please Insert Brand Image'
        ]);

        $brand_image = $request->file('brand_image');

        
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen . '.' . $img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location . $img_name;
        
        // $brand_image->move($up_location,$img_name);

        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        $up_location = 'image/brand/';

        
        Image::make($brand_image)->resize(300,200)->save($up_location.$name_gen);
        $last_img = $up_location . $name_gen;

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $last_img;
        $brand->save();

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    }

    public function Edit($id){
        $brand = Brand::find($id);

        return view('admin.brand.edit',compact('brand'));
    }

    public function Update(Request $request , $id){

        $updateBrandValidation = $request->validate([
            'brand_name' => 'required|min:4'
        ],[
            'brand_name:required' => 'Please Insert Brand Name',
            'brand_name:min' => 'please Insert More Than 4 Characters'

        ]);

        $brand_Old_Image = $request->old_image;

        $brand_image = $request->file('brand_image');
        if($brand_image){
            $img_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $img_gen .'.'. $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;

            $brand_image->move($up_location , $last_img);

            unlink($brand_Old_Image);

            Brand::find($id)->Update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
            $notification = array([
                'message' => 'Brand Updated Successfully' ,
                'alert-type' => 'info'
            ]);

            return redirect()->route('all.brand')->with($notification);
        }else{
            Brand::find($id)->Update([
                'brand_name' => $request->brand_name,
                'updatedat' => Carbon::now()
            ]);

            $notification = array([
                'message' => 'Brand Updated Successfully' ,
                'alert-type' => 'info'
            ]);

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function Delete($id){

        $image = Brand::find($id);
        $old_image = $image->brand_image;

        $image->Delete();
        unlink($old_image);

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
}
