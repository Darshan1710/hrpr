<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactStore(ContactRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $type = $request->input('type');
        $comment = $request->input('comment');

        //store in database
        $storeEnquiryDetail = new Enquiry();
        $storeEnquiryDetail->name = $name;
        $storeEnquiryDetail->email = $email;
        $storeEnquiryDetail->mobile = $mobile;
        $storeEnquiryDetail->type = $type ;
        $storeEnquiryDetail->comment = $comment;

        $saveEnquiry = $storeEnquiryDetail->save();

        if ($saveEnquiry) {
            Mail::to("shindetejas61@gmail.com")->send(new ContactMail($name, $email, $mobile, $type, $comment));
            // $request->session()->flash('flash_notification.message', 'Contact successfully submitted.');
            // $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('contact');
        } else {

            // $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            // $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('contact');
        }
    }
}
