<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialsRequest;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonialsList = Testimonials::orderBy('id', 'DESC')->get();
        return view('admin.testimonials.index', compact('testimonialsList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialsRequest $request)
    {
        $name = $request->input('name');
        $testimonials = $request->input('testimonials');

        $storeTestimonials = new Testimonials();
        $storeTestimonials->name = $name;
        $storeTestimonials->testimonials = $testimonials;

        $saveTestimonials = $storeTestimonials->save();

        if ($saveTestimonials) {
            $request->session()->flash('flash_notification.message', 'New Testimonials was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.testimonials.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.testimonials.create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TestimonialsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $testimonials = Testimonials::find($id);
        if (isset($testimonials)) {
            return view('admin.testimonials.edit', compact('testimonials'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.testimonials.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param TestimonialsRequest $request
     * @param  int $id
     * @return void
     */
    public function update(TestimonialsRequest $request, $id)
    {
        $name = $request->input('name');
        $testimonials = $request->input('testimonials');

        $updateTestimonials = Testimonials::find($id);
        $updateTestimonials->name = $name;
        $updateTestimonials->testimonials = $testimonials;

        $saveTestimonials = $updateTestimonials->save();

        if (isset($saveTestimonials)) {
            $request->session()->flash('flash_notification.message', 'Testimonials was successfully updated.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.testimonials.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.testimonials.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TestimonialsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $testimonials = Testimonials::find($id);
        if (isset($testimonials)) {

            $operationStatus = $testimonials->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Testimonials was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.testimonials.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.testimonials.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.testimonials.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $testimonialsList = Testimonials::onlyTrashed()->get();
        return view('admin.testimonials.deleted', compact('testimonialsList'));
    }

    /**
     * Restore the selected resource
     *
     * @param TestimonialsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(TestimonialsRequest $request, $id)
    {

        $testimonials = Testimonials::withTrashed()->find($id);
        if (isset($testimonials)) {

            $operationStatus = $testimonials->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Testimonials successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.testimonials.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.testimonials.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.testimonials.deleted');
        }
    }
}
