<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobApplicationList = JobApplication::select('job_applications.job_id', 'job_applications.id', 'job_applications.name', 'job_applications.phone', 'job_applications.email', 'job_applications.job_sector', 'job_applications.comment', 'job_applications.file_path', 'job_openings.id as opening_id', 'job_openings.category', 'categories.id as category_id ', 'categories.category')

            ->join('job_openings', 'job_applications.job_id', '=', 'job_openings.id')
            ->join('categories', 'job_openings.category', '=', 'categories.id')
            // ->toSql();
            ->groupBy('job_applications.job_id', 'job_applications.id', 'job_applications.name', 'job_applications.phone', 'job_applications.email', 'job_applications.job_sector', 'job_applications.comment', 'job_applications.file_path', 'job_openings.id', 'job_openings.category', 'categories.id', 'categories.category')
            ->get();

        // dd($jobApplicationList);
        return view('admin.application.index', compact('jobApplicationList'));
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
        $jobApplication = JobApplication::select('job_applications.job_id', 'job_applications.id', 'job_applications.name', 'job_applications.phone', 'job_applications.email', 'job_applications.job_sector', 'job_applications.comment', 'job_applications.file_path', 'job_openings.id as opening_id', 'job_openings.category', 'categories.id as category_id ', 'categories.category')

            ->join('job_openings', 'job_applications.job_id', '=', 'job_openings.id')
            ->join('categories', 'job_openings.category', '=', 'categories.id')
            // ->where()
            ->groupBy('job_applications.job_id', 'job_applications.id', 'job_applications.name', 'job_applications.phone', 'job_applications.email', 'job_applications.job_sector', 'job_applications.comment', 'job_applications.file_path', 'job_openings.id', 'job_openings.category', 'categories.id', 'categories.category')
            ->find($id);
        if (isset($jobApplication)) {
            return view('admin.application.edit', compact('jobApplication'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.application.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EnquiryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $jobApplication = JobApplication::find($id);
        if (isset($jobApplication)) {

            $operationStatus = $jobApplication->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Application was successfully completed.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.application.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.application.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.application.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $jobApplicationList = JobApplication::select('job_applications.job_id', 'job_applications.id', 'job_applications.name', 'job_applications.phone', 'job_applications.email', 'job_applications.job_sector', 'job_applications.comment', 'job_applications.file_path', 'job_openings.id as opening_id', 'job_openings.category', 'categories.id as category_id ', 'categories.category')

            ->join('job_openings', 'job_applications.job_id', '=', 'job_openings.id')
            ->join('categories', 'job_openings.category', '=', 'categories.id')
            ->groupBy('job_applications.job_id', 'job_applications.id', 'job_applications.name', 'job_applications.phone', 'job_applications.email', 'job_applications.job_sector', 'job_applications.comment', 'job_applications.file_path', 'job_openings.id', 'job_openings.category', 'categories.id', 'categories.category')
            ->onlyTrashed()
            ->get();        
            return view('admin.application.deleted', compact('jobApplicationList'));
    }

    /**
     * Restore the selected resource
     *
     * @param EnquiryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(Request $request, $id)
    {

        $jobApplication = JobApplication::withTrashed()->find($id);
        if (isset($jobApplication)) {

            $operationStatus = $jobApplication->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Application successfully Pending. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.application.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.application.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.application.deleted');
        }
    }
}
