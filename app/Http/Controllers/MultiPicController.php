<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\Multipic;

class MultiPicController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function Multi_Images(){

        $images = Multipic::all();

        return view('admin.multipic.index',compact('images'));
    }

    public function StoreImages(Request $request){

        $MultiImagesValidator = $request->validate([
            'images' => "required"
        ],[
            'images:required' => 'Please Insert Some Images'
        ]);

        $images = $request->file('images');

        
        foreach($images as $img){
            $img_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $up_location = 'image/multi/';
            Image::make($img)->resize(250,250)->save($up_location.$img_gen);

            $last_img = $up_location . $img_gen;

            $image = new Multipic();
            $image->image = $last_img;
            $image->save();
        }

        $notification = array([
            'message' => 'Images Inserted Successfully ',
            'alert-type' => 'success'
        ]);
        return redirect()->back()->with($notification);
    }
}
