<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicesList = Services::orderBy('id', 'DESC')->get();
        return view('admin.services.index', compact('servicesList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesRequest $request)
    {
        //upload the file and link it up
        if ($request->hasFile('services-image')) {

            if ($request->file('services-image')->isValid()) {

                $serviceTitle = $request->input('title');
                $description = $request->input('description');
                $service_image = $request->file('services-image'); // the image  file
                $service_image_name = $service_image->getClientOriginalName(); //the file name with extension
                $service_image_extension = $service_image->getClientOriginalExtension(); // the file extension
                $service_image_path = pathinfo($service_image_name, PATHINFO_FILENAME) . '_' . time() . '.' . $service_image_extension; //generate new random name of the file

                $allowed_file_types = ['jpg', 'jpeg', 'png']; // allowed extensions

                if (in_array($service_image_extension, $allowed_file_types)) {

                    // move uploaded files to directories and generate url
                    $service_image->move(public_path('assets/images/service_images'), $service_image_path);

                    //store in database
                    $newFile = new Services();
                    $newFile->title = $serviceTitle;
                    $newFile->description = $description;
                    $newFile->image_name = $service_image_name;
                    $newFile->image_path = $service_image_path;
                    $servicesImageUploadStatus = $newFile->save();

                    if ($servicesImageUploadStatus) {
                        $request->session()->flash('flash_notification.message', 'New Services was successfully created.');
                        $request->session()->flash('flash_notification.level', 'success');
                        return redirect()->route('admin.services.index')->withInput();
                    } else {

                        $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('admin.services.create');
                    }
                } else {

                    $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                    $request->session()->flash('flash_notification.level', 'danger');
                    return redirect()->route('admin.services.create')->withInput();
                }
            }
        } else {
            $request->session()->flash('flash_notification.message', 'New Services was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.services.index');
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
        $services = Services::find($id);
        if (isset($services)) {
            return view('admin.services.edit', compact('services'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.services.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ServicesRequest $request
     * @param  int $id
     * @return void
     */
    public function update(ServicesRequest $request, $id)
    {
        $servicesTitle = $request->input('title');
        $serviceDescription = $request->input('description');

        //store in database
        $updateService = Services::find($id);
        $updateService->title = $servicesTitle;
        $updateService->description = $serviceDescription;
        $serviceUpdateStatus = $updateService->save();

        if ($serviceUpdateStatus) {

            if ($request->hasFile('services-image')) {
                if ($request->file('services-image')->isValid()) {

                    $service_image = $request->file('services-image'); // the image  file
                    $service_image_name = $service_image->getClientOriginalName(); //the file name with extension
                    $service_image_extension = $service_image->getClientOriginalExtension(); // the file extension
                    $service_image_path = pathinfo($service_image_name, PATHINFO_FILENAME) . '_' . time() . '.' . $service_image_extension; //generate new random name of the file
                    $service_image_types = ['jpg', 'jpeg', 'png']; // allowed extensions

                    if (in_array($service_image_extension, $service_image_types)) {

                        // move uploaded files to directories and generate url
                        $service_image->move(public_path('assets/images/service_images'), $service_image_path);

                        //store in database
                        $updateImage = Services::find($id);

                        $updateImage->image_name = $service_image_name;
                        $updateImage->image_path = $service_image_path;
                        $serviceImageUpdateStatus = $updateImage->save();

                        if ($serviceImageUpdateStatus) {
                            $request->session()->flash('flash_notification.message', 'New Service was successfully updated.');
                            $request->session()->flash('flash_notification.level', 'success');
                            return redirect()->route('admin.services.index')->withInput();
                        } else {
                            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                            $request->session()->flash('flash_notification.level', 'danger');
                            return redirect()->route('admin.services.edit', $id);
                        }
                    } else {
                        $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('admin.services.edit', $id)->withInput();
                    }
                }
            } else {
                $request->session()->flash('flash_notification.message', 'New Service was successfully updated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.services.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.services.edit', $id);
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
        $services = Services::find($id);
        if (isset($services)) {

            $operationStatus = $services->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Services was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.services.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.services.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.services.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $servicesList = Services::onlyTrashed()->get();
        return view('admin.services.deleted', compact('servicesList'));
    }

    /**
     * Restore the selected resource
     *
     * @param TestimonialsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(ServicesRequest $request, $id)
    {

        $services = Services::withTrashed()->find($id);
        if (isset($services)) {

            $operationStatus = $services->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Services successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.services.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.services.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.services.deleted');
        }
    }
}
