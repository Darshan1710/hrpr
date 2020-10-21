<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderList = Slider::orderBy('id', 'DESC')->get();
        return view('admin.slider.index', compact('sliderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider = new Slider();
        $slider->slider_title = $request->input('slider-title');
        $slider->video_url = $request->input('video-url');
        $operationStatus = $slider->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Slider successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.slider.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $slider = Slider::find($id);
        if (isset($slider)) {
            return view('admin.slider.edit', compact('slider'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param  int $id
     * @return void
     */
    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::find($id);
        $slider->slider_title = $request->input('slider-title');
        $slider->video_url = $request->input('video-url');
        $operationStatus = $slider->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Slider successfully updated.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.slider.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $slider = Slider::find($id);
        if (isset($slider)) {

            $operationStatus = $slider->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Slider was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.slider.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.slider.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $sliderList = Slider::onlyTrashed()->get();
        return view('admin.slider.deleted', compact('sliderList'));
    }

    /**
     * Restore the selected resource
     *
     * @param TestimonialsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(SliderRequest $request, $id)
    {

        $slider = Slider::withTrashed()->find($id);
        if (isset($slider)) {

            $operationStatus = $slider->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Slider successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.slider.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.slider.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.deleted');
        }
    }
}
