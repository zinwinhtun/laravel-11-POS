<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{

    //go to contact blade
    public function index(){
        return view('Client.Template.Contact.contactMail');
    }
    //send maul
    public function sendMail(Request $request){
        //save to DB after validation
        $this->dataValidtion($request);
        Contact::create($request->all());

        //mail send process
        $data = [
            'user_id' => Auth::user()->id,
            'user_email' => Auth::user()->email,
            'user_name' => Auth::user()->name,
            'title' => $request->title,
            'message' => $request->message
        ];

        $adminMail = "zcoder71@gmail.com";
        Mail::to($adminMail)->send(new ContactEmail($data));

        Alert::success('Mail Send','You Message Is Successfully Deliever..');
        return back();
    }

    //data validation
    private function dataValidtion($request){
        $request->validate([
            'title' => 'required|min:5',
            'message' => 'required|max:200'
        ]);
    }
}
