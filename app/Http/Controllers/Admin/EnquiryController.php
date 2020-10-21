<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $enquiryList = Enquiry::orderBy('id', 'DESC')->get();
        return view('admin.enquiry.index');
    }

    /**
     * @param Request $request
     * @return mixed|ParameterBag
     */
    //datatable pagination for product index page
    public function pagination(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'mobile',
            3 => 'email',
            4 => 'comment',
            5 => 'type',
        );
        $totalData = Enquiry::all()->count();

        $totalFiltered = $totalData;
        $dataTableColumns = $request->input('columns');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts = Enquiry::
        where(function ($q) use ($dataTableColumns) {
                foreach($dataTableColumns as $column){
                $columnName = $column['data'];
                $searchTerm = $column['search']['value'];

                if($searchTerm != null && $searchTerm != ""){
                    $q->where($columnName, 'LIKE', "%{$searchTerm}%");
                }
            }
        })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = Enquiry::
        where(function ($q) use ($dataTableColumns) {
            foreach ($dataTableColumns as $column) {
                $columnName = $column['data'];
                $searchTerm = $column['search']['value'];

                if ($searchTerm != null && $searchTerm != "") {
                    $q->orWhere($columnName, 'LIKE', "%{$searchTerm}%");
                }
            }
        })
        ->get()
        ->count();

        $data = array();
        if (!empty($posts)) {

            if ($dir == 'desc') {
                $iteration = $totalData - $start;
            } elseif ($dir == 'asc') {
                $iteration = $start;
            }
            foreach ($posts as $post) {
                if ($dir == 'desc') {
                    $iteration--;
                } elseif ($dir == 'asc') {
                    $iteration++;
                }

                $nestedData['iteration'] = $iteration;
                $nestedData['name'] = $post->name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['email'] = $post->email;
                $nestedData['comment'] = $post->comment;
                $nestedData['type'] = $post->type;
                $nestedData['id'] = $post->id;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return response()->json($json_data);
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
        $enquiry = Enquiry::find($id);
        if (isset($enquiry)) {
            return view('admin.enquiry.edit', compact('enquiry'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.enquiry.index');
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
        $enquiry = Enquiry::find($id);
        if (isset($enquiry)) {

            $operationStatus = $enquiry->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Enquiry was successfully completed.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.enquiry.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.enquiry.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.enquiry.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $enquiryList = Enquiry::onlyTrashed()->get();
        return view('admin.enquiry.deleted', compact('enquiryList'));
    }

    /**
     * Restore the selected resource
     *
     * @param EnquiryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(EnquiryRequest $request, $id)
    {

        $enquiry = Enquiry::withTrashed()->find($id);
        if (isset($enquiry)) {

            $operationStatus = $enquiry->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Enquiry successfully Pending. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.enquiry.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.enquiry.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.enquiry.deleted');
        }
    }
}
