<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientList = Client::orderBy('id', 'DESC')->get();
        return view('admin.client.index', compact('clientList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        //upload the file and link it up
        if ($request->hasFile('client-image')) {

            if ($request->file('client-image')->isValid()) {

                $clientTitle = $request->input('client-title');
                $client_image = $request->file('client-image'); // the image  file
                $client_image_name = $client_image->getClientOriginalName(); //the file name with extension
                $client_image_extension = $client_image->getClientOriginalExtension(); // the file extension
                $client_image_path = pathinfo($client_image_name, PATHINFO_FILENAME) . '_' . time() . '.' . $client_image_extension; //generate new random name of the file

                $allowed_file_types = ['jpg', 'jpeg', 'png']; // allowed extensions

                if (in_array($client_image_extension, $allowed_file_types)) {

                    // move uploaded files to directories and generate url
                    $client_image->move(public_path('assets/images/client_images'), $client_image_path);

                    //store in database
                    $newFile = new Client();
                    $newFile->client_title = $clientTitle;
                    $newFile->image_name = $client_image_name;
                    $newFile->image_path = $client_image_path;
                    $clientImageUploadStatus = $newFile->save();

                    if ($clientImageUploadStatus) {
                        $request->session()->flash('flash_notification.message', 'New Client was successfully created.');
                        $request->session()->flash('flash_notification.level', 'success');
                        return redirect()->route('admin.client.index')->withInput();
                    } else {

                        $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('admin.client.create');
                    }
                } else {

                    $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                    $request->session()->flash('flash_notification.level', 'danger');
                    return redirect()->route('admin.client.create')->withInput();
                }
            }
        } else {
            $request->session()->flash('flash_notification.message', 'New Slider was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.client.index');
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
        $client = Client::find($id);
        if (isset($client)) {
            return view('admin.client.edit', compact('client'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.client.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ClientRequest $request
     * @param  int $id
     * @return void
     */
    public function update(ClientRequest $request, $id)
    {
        $clientTitle = $request->input('client-title');

        //store in database
        $updateClient = Client::find($id);
        $updateClient->client_title = $clientTitle;
        $clientUpdateStatus = $updateClient->save();

        if ($clientUpdateStatus) {

            if ($request->hasFile('client-image')) {
                if ($request->file('client-image')->isValid()) {

                    $client_image = $request->file('client-image'); // the image  file
                    $client_image_name = $client_image->getClientOriginalName(); //the file name with extension
                    $client_image_extension = $client_image->getClientOriginalExtension(); // the file extension
                    $client_image_path = pathinfo($client_image_name, PATHINFO_FILENAME) . '_' . time() . '.' . $client_image_extension; //generate new random name of the file
                    $client_image_types = ['jpg', 'jpeg', 'png']; // allowed extensions

                    if (in_array($client_image_extension, $client_image_types)) {

                        // move uploaded files to directories and generate url
                        $client_image->move(public_path('assets/images/client_images'), $client_image_path);
                        //store in database
                        $updateImage = Client::find($id);

                        $updateImage->image_name = $client_image_name;
                        $updateImage->image_path = $client_image_path;
                        $clientImageUpdateStatus = $updateImage->save();

                        if ($clientImageUpdateStatus) {
                            $request->session()->flash('flash_notification.message', 'New Client was successfully updated.');
                            $request->session()->flash('flash_notification.level', 'success');
                            return redirect()->route('admin.client.index')->withInput();
                        } else {
                            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                            $request->session()->flash('flash_notification.level', 'danger');
                            return redirect()->route('admin.client.edit', $id);
                        }
                    } else {
                        $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('admin.client.edit', $id)->withInput();
                    }
                }
            } else {
                $request->session()->flash('flash_notification.message', 'New Slider was successfully updated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.client.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.client.edit', $id);
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
        $client = Client::find($id);
        if (isset($client)) {

            $operationStatus = $client->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Client was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.client.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.client.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.client.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $clientList = Client::onlyTrashed()->get();
        return view('admin.client.deleted', compact('clientList'));
    }

    /**
     * Restore the selected resource
     *
     * @param TestimonialsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(ClientRequest $request, $id)
    {

        $client = Client::withTrashed()->find($id);
        if (isset($client)) {

            $operationStatus = $client->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Client successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.client.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.client.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.client.deleted');
        }
    }
}
