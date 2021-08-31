<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ContactController;

use App\Models\Contact;
use App\Models\ContactForm;

use Auth;


class ContactController extends Controller
{
    //
    Public function __construct(){
        $this->middleware('auth');
    }
    public function AdminContact(){

        $contacts = Contact::latest()->paginate(5);

        return view('admin.contact.index',compact('contacts'));
    }

    public function AdminAddContact(){

        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request){

        $contact_validateion = $request->validate([
            'email' => 'required|email|max:255',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);


        $contact = new Contact();
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->created_at = Carbon::now();
        $contact->save();

        $notification = array([
            'message' => 'Contact Inserted Successfully',
            'alert-type' => 'success'
        ]);

        return redirect()->route('admin.contact')->with($notification);
    }

    public function EditContact($id){
        $updateContact = Contact::find($id);

        return view('admin.contact.edit',compact('updateContact'));
    }

    public function UpdateContact(Request $request , $id){

        // $contact_validateion = $request->validate([
        //     'email' => 'required|email|max:255',
        //     'address' => 'required',
        //     'phone' => 'required|numeric'
        // ]);

        Contact::find($id)->Update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()
        ]);

        $notification = array([
            'message' => 'Contact Updated Successfully',
            'alert-type' => 'info'
        ]);

        return redirect()->route('admin.contact')->with($notification);
    }

    public function DeleteContact($id){
        Contact::find($id)->delete();

        $notification = array([
            'message' => 'Contact Deleted Successfully',
            'alert-type' => 'warning'
        ]);

        return redirect()->route('admin.contact')->with($notification);

    }

    public function Contact(){

        $contact = DB::table('contacts')->first();
        return view('pages.contact',compact('contact'));
    }

    public function ContactForm(Request $request){
        DB::table('contact_forms')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = array([
            'message' => 'Your Message Send Successfully ',
            'alert-type' => 'success'
        ]); 

        return redirect()->back()->with($notification);
    }

    public function ContactMessages(){
        $messages = ContactForm::latest()->paginate(5);

        return view('admin.contact.message',compact('messages'));
    }

    public function DeleteContactMessage($id){
        ContactForm::find($id)->delete();

        $notification = array([
            'message' => 'Message Deleted Successfully ',
            'alert-type' => 'warning'
        ]); 
        return redirect()->back()->with($notification);
    }
}
