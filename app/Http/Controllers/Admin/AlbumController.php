<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albumList = Album::orderBy('id', 'DESC')->get();
        return view('admin.album.index', compact('albumList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $album = $request->input('album');

        $newAlbum = new Album();
        $newAlbum->album = $album;

        $saveAlbum = $newAlbum->save();

        if ($saveAlbum) {
            $request->session()->flash('flash_notification.message', 'New Album was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.album.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.album.create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommitteeTypeRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $album = Album::find($id);
        if (isset($album)) {
            return view('admin.album.edit', compact('album'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.album.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CommitteeTypeRequest $request
     * @param  int $id
     * @return void
     */
    public function update(AlbumRequest $request, $id)
    {
        $album = $request->input('album');

        $updateAlbum = Album::find($id);
        $updateAlbum->album = $album;
        $saveAlbum = $updateAlbum->save();

        if (isset($saveAlbum)) {
            $request->session()->flash('flash_notification.message', 'Album was successfully updated.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.album.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.album.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeTypeRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $album = Album::find($id);
        if (isset($album)) {

            $operationStatus = $album->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Album was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.album.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.album.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.album.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $albumList = Album::onlyTrashed()->get();
        return view('admin.album.deleted', compact('albumList'));
    }

    /**
     * Restore the selected resource
     *
     * @param CommitteeTypeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(AlbumRequest $request, $id)
    {

        $album = Album::withTrashed()->find($id);
        if (isset($album)) {

            $operationStatus = $album->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Album successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.album.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.album.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.album.deleted');
        }
    }
}
