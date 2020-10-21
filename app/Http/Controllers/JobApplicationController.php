<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applicationStore(JobApplicationRequest $request)
    {
        //upload the file and link it up
        if ($request->hasFile('cv')) {

            if ($request->file('cv')->isValid()) {

                $jobId = $request->input('job-id');
                $name = $request->input('name');
                $phone = $request->input('phone');
                $email = $request->input('email');
                $jobSector = $request->input('job-sector');
                $comment = $request->input('comment');
                $cv_file = $request->file('cv'); // the file
                $cv_file_name = $cv_file->getClientOriginalName(); //the file name with extension
                $cv_file_extension = $cv_file->getClientOriginalExtension(); // the file extension
                $cv_file_path = pathinfo($cv_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $cv_file_extension; //generate new random name of the file

                $allowed_file_types = ['pdf', 'doc', 'dot', 'wbk', 'docx', 'docm', 'dotx', 'dotm', 'docb', 'txt']; // allowed extensions

                if (in_array($cv_file_extension, $allowed_file_types)) {

                    // move uploaded files to directories and generate url
                    $cv_file->move(public_path('assets/files/cv_files'), $cv_file_path);

                    //store in database
                    $newFile = new JobApplication();
                    $newFile->job_id = $jobId;
                    $newFile->name = $name;
                    $newFile->phone = $phone;
                    $newFile->email = $email;
                    $newFile->job_sector = $jobSector;
                    $newFile->comment = $comment;
                    $newFile->file_name = $cv_file_name;
                    $newFile->file_path = $cv_file_path;
                    $cvUploadStatus = $newFile->save();

                    if ($cvUploadStatus) {
                        $request->session()->flash('flash_notification.message', 'CV was successfully uploaded.');
                        $request->session()->flash('flash_notification.level', 'success');
                        return redirect()->back();
                    } else {

                        $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('jobOpening');
                    }
                } else {

                    $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                    $request->session()->flash('flash_notification.level', 'danger');
                    return redirect()->route('jobOpening')->withInput();
                }
            }
        } else {
            $request->session()->flash('flash_notification.message', 'CV was successfully uploaded.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('jobOpening');
        }

        //             if ($cvUploadStatus) {
        //                 $message = 'CV was successfully uploaded.';
        //             } else {

        //                 $message = 'Something went wrong, please try again later.';
                        
        //             }
        //         } else {

        //             $message = 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.';
                    
        //         }
        //     }
        // } else {
        //     $message =  'CV was successfully uploaded.';
        // }

        // return json_encode($message);
    }
}
