<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnquiryRequest;
use App\Mail\EnquiryMail;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enquiryStore(EnquiryRequest $request)
    {
        $enquiryName = $request->input('enquiry-name');
        $enquiryEmail = $request->input('enquiry-email');
        $enquiryMobile = $request->input('enquiry-mobile');
        $enquiryType = $request->input('enquiry-type');
        $enquiryComment = $request->input('enquiry-comment');

        //store in database
        $storeEnquiryDetail = new Enquiry();
        $storeEnquiryDetail->name = $enquiryName;
        $storeEnquiryDetail->email = $enquiryEmail;
        $storeEnquiryDetail->mobile = $enquiryMobile;
        $storeEnquiryDetail->type = $enquiryType;
        $storeEnquiryDetail->comment = $enquiryComment;

        $saveEnquiry = $storeEnquiryDetail->save();

        if ($saveEnquiry) {
            Mail::to("shindetejas61@gmail.com")->send(new EnquiryMail($enquiryName, $enquiryEmail, $enquiryMobile, $enquiryType, $enquiryComment));

            // $request->session()->flash('flash_notification.message', 'Enquiry successfully submitted.');
            // $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('home');
        } else {

            // $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            // $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('home');
        }
    }
}
