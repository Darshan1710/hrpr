<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\JobOpening;
use App\Models\Services;
use App\Models\Slider;
use App\Models\Testimonials;

class PagesController extends Controller
{
    /**
     * Home Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $slider = Slider::all();
        $testimonials = Testimonials::all();
        $client = Client::all();
        return view('pages.home', compact('slider', 'testimonials', 'client'));
    }

    /**
     * About Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Services Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services()
    {
        $services = Services::all();
        return view('pages.services', compact('services'));
    }

    /**
     * Services Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleServices($id)
    {
        $singleServices = Services::find($id);
        return view('pages.singleServices', compact('singleServices'));
    }

    /**
     * jobOpning Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobOpening()
    {
        $jobOpening = JobOpening::all();
        return view('pages.jobOpening', compact('jobOpening'));
    }

    /**
     * gallery Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery()
    {
        $album = Album::all();
        $gallery = Gallery::get();
        foreach ($gallery as $key => $element) {

            $albumID = Album::find($element->album_id,);
            if(!isset($albumID)){
                unset($gallery[$key]);
            } else{
            $element['album'] = $albumID->album;
            }

        }
        return view('pages.gallery', compact('gallery', 'album'));
    }

    /**
     * contact Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * contact Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hrsolutions()
    {
        return view('pages.hrsolutions');
    }

     /**
     * contact Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prsolutions()
    {
        return view('pages.prsolutions');
    }
}
