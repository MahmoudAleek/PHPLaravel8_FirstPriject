<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Slider;
use App\Models\Service;
use Auth;
use Image;

class HomeController extends Controller
{
    //
    public function HomeSlider(){
        $sliders = Slider::latest()->paginate(5);

        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider(){

        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){

        $slider_image = $request->file('image');
        $img_gen = hexdec(uniqid()) .'.'. $slider_image->getClientOriginalExtension();
        $up_location = 'image/slider/';
        $last_img = $up_location . $img_gen;
        Image::make($slider_image)->resize(1920,1088)->save($last_img);


        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $last_img;
        $slider->created_at = Carbon::now();
        $slider->save();

        $notification = array([
            'message' => 'Slider Inserted Successfully ',
            'alert-type' => 'success'
        ]);
        return redirect()->route('home.slider')->with($notification);
    }

    public function EditSlider($id){

        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }

    public function UpdateSlider(Request $request , $id){

        $slider_old_image = $request->slider_old_image;

        $slider_image = $request->file('image');
        $img_gen = hexdec(uniqid()) .'.'. $slider_image->getClientOriginalExtension();
        $up_location = 'image/slider/';
        $last_img = $up_location . $img_gen;
        Image::make($slider_image)->resize(1920,1088)->save($last_img);

        unlink($slider_old_image);
        
        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->description = $request->descriprion;
        $slider->image = $last_img;
        $slider->update();

        $notification = array([
            'message' => 'Slider Updated Successfully ',
            'alert-type' => 'info'
        ]);
        return redirect()->route('home.slider')->with($notification);
    }

    public function DeleteSlider($id){
        $slider = Slider::find($id);
        unlink($slider->image);
        $slider->delete();

        $notification = array([
            'message' => 'Slider Deleted Successfully ',
            'alert-type' => 'warning'
        ]);
        return redirect()->route('home.slider')->with($notification);
    }



    /*{{{ Services section  }}}*/

    public function HomeService(){
        $services =  Service::latest()->paginate(5);
   
        return view('admin.service.index',compact('services'));
    }

    public function AddService(){
        return view('admin.service.create');
    }

    public function StoreService(Request $request){


        $service_image = $request->file('image');
        $img_gen = hexdec(uniqid()) .'.'. $service_image->getClientOriginalExtension();
        $up_location = 'image/service/';
        $last_img = $up_location . $img_gen;
        Image::make($service_image)->resize(50,50)->save($last_img);

        $service = new Service();
        $service->title = $request->title;
        $service->short_des = $request->description;
        $service->image = $last_img;
        $service->save();

        $notification = array([
            'message' => 'Service Inserted Successfully ',
            'alert-type' => 'success'
        ]);
        return redirect()->route('home.service')->with($notification);
    }

}
