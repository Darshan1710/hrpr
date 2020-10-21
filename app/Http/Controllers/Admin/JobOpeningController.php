<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobOpeningRequest;
use App\Models\Category;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobOpeningList = JobOpening::select('job_openings.id', 'job_openings.job_title', 'job_openings.category', 'job_openings.description', 'job_openings.skillset', 'job_openings.location', 'job_openings.required_experience', 'categories.id as category_id', 'categories.category')

            ->join('categories', 'job_openings.category', '=', 'categories.id')
            // ->toSql();
            -> groupBy('job_openings.id', 'job_openings.job_title', 'job_openings.category', 'job_openings.description', 'job_openings.skillset', 'job_openings.location', 'job_openings.required_experience', 'categories.id', 'categories.category')
            ->get();        
            return view('admin.jobOpening.index', compact('jobOpeningList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = Category::orderBy('id', 'DESC')->get();
        return view('admin.jobOpening.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobOpeningRequest $request)
    {
        $jobTitle = $request->input('job-title');
        $category = $request->input('category');
        $description = $request->input('description');
        $skillset = $request->input('skillset');
        $location = $request->input('location');
        $requiredExperience = $request->input('required-experience');

        $storeJobOpening = new JobOpening();
        $storeJobOpening->job_title = $jobTitle;
        $storeJobOpening->category = $category;
        $storeJobOpening->description = $description;
        $storeJobOpening->skillset = $skillset;
        $storeJobOpening->location = $location;
        $storeJobOpening->required_experience = $requiredExperience;

        $saveJobOpening = $storeJobOpening->save();

        if ($saveJobOpening) {
            $request->session()->flash('flash_notification.message', 'New Job was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.jobOpening.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.jobOpening.create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobOpeningRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $jobOpening = JobOpening::find($id);
        $categoryList = Category::all();
        if (isset($jobOpening)) {
            return view('admin.jobOpening.edit', compact('jobOpening', 'categoryList'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.jobOpening.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CommitteeTypeRequest $request
     * @param  int $id
     * @return void
     */
    public function update(JobOpeningRequest $request, $id)
    {
        $jobTitle = $request->input('job-title');
        $category = $request->input('category');
        $description = $request->input('description');
        $skillset = $request->input('skillset');
        $location = $request->input('location');
        $requiredExperience = $request->input('required-experience');

        $updateJobOpening = JobOpening::find($id);
        $updateJobOpening->job_title = $jobTitle;
        $updateJobOpening->category = $category;
        $updateJobOpening->description = $description;
        $updateJobOpening->skillset = $skillset;
        $updateJobOpening->location = $location;
        $updateJobOpening->required_experience = $requiredExperience;

        $saveJobOpening = $updateJobOpening->save();

        if (isset($saveJobOpening)) {
            $request->session()->flash('flash_notification.message', 'Job was successfully updated.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.jobOpening.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.jobOpening.index');
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
        $jobOpening = JobOpening::find($id);
        if (isset($jobOpening)) {

            $operationStatus = $jobOpening->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Job was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.jobOpening.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.jobOpening.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.jobOpening.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $jobOpeningList = JobOpening::select('job_openings.id', 'job_openings.job_title', 'job_openings.category', 'job_openings.description', 'job_openings.skillset', 'job_openings.location', 'job_openings.required_experience', 'categories.id as category_id', 'categories.category')

            ->join('categories', 'job_openings.category', '=', 'categories.id')
            // ->toSql();
            ->groupBy('job_openings.id', 'job_openings.job_title', 'job_openings.category', 'job_openings.description', 'job_openings.skillset', 'job_openings.location', 'job_openings.required_experience', 'categories.id', 'categories.category')
            ->onlyTrashed()
            ->get(); 
            return view('admin.jobOpening.deleted', compact('jobOpeningList'));
    }

    /**
     * Restore the selected resource
     *
     * @param CommitteeTypeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(JobOpeningRequest $request, $id)
    {

        $jobopening = JobOpening::withTrashed()->find($id);
        if (isset($jobopening)) {

            $operationStatus = $jobopening->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Job successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.jobOpening.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.jobOpening.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.jobOpening.deleted');
        }
    }
}
