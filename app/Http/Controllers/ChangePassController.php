<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;


class ChangePassController extends Controller
{

    public function __constract(){
        $this->middleware('auth');
    }

    public function CPassword(){
        return view('admin.body.change_password');
    }

    public function Update_Password(Request $request ){
        $password_validator = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $oldPassword = Auth::user()->password;
        
        if(Hash::check($request->current_password,$oldPassword)){

            
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
            Auth::logout();

            $notification = array([
                'message' => 'Password Is Changed Successfully',
                'alert-type' => 'success'
            ]);

            return redirect()->route('login')->with($notification);
        }else{
            $notification = array([
                'message' => 'Current Password Is Invalid',
                'alert-type' => 'error'
            ]);
            return redirect()->back()->with($notification);
        }
    }


    public function EProfile(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }

    public function UProfile(Request $request){
        $profileValidator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);


        $user = User::find(Auth::user()->id);
        if(isset($user)){

            $newImage = $request->file('image');
            $oldImage = $request['old_img'];
            
            if($request->file('image')){

                $img_gen = hexdec(uniqid()) .'.'. strtolower($newImage->getClientOriginalExtension());
                $up_location = 'storage/profile-photos/';
                $last_img = $up_location . $img_gen;
                Image::make($newImage)->resize(200,200)->save($last_img); 
                $user->profile_photo_path = $last_img;  
                
                if($oldImage!=null){
                    unlink($oldImage);
                }
            }


            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();    

            $notification = array([
                'message' => 'User Profile Updated Successfully',
                'alert-type' => 'success'
            ]);
            return redirect()->back()->with($notification);
        }else{
            return redirect()->back();
        }
    }
}
