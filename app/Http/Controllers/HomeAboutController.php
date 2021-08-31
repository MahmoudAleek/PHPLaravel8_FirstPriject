<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Carbon;

class HomeAboutController extends Controller
{
    //
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->paginate(5);
        return view('admin.about.index',compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request){
        $aboutValidation = $request->validate([
            'title' => 'required|max:255',
            'short_des' => 'required|',
            'long_des' => 'required|'
        ]);

        HomeAbout::Insert([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        $notification = array([
            'message' => 'About Inserted Successfully ',
            'alert-type' => 'success'
        ]);
        return redirect()->route('home.about')->with($notification);
    }

    public function EditAbout($id){
        $about = HomeAbout::find($id);
        return view('admin.about.edit',compact('about'));
    }

    public function UpdateAbout(Request $request , $id){

        HomeAbout::find($id)->Update([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'updated_at' => Carbon::now()
        ]);

        $notification = array([
            'message' => 'About Updated Successfully ',
            'alert-type' => 'info'
        ]);
        return redirect()->route('home.about')->with($notification);
    }

    public function DeleteAbout($id){
        $deleteAbout = HomeAbout::find($id);
        $deleteAbout->delete();

        $notification = array([
            'message' => 'About Deleted Successfully ',
            'alert-type' => 'warning'
        ]);

        return redirect()->back()->with($notification);
    }



}
