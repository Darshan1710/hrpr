<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryList = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->input('category');

        $newCategory = new Category();
        $newCategory->category = $category;

        $saveCategory = $newCategory->save();

        if ($saveCategory) {
            $request->session()->flash('flash_notification.message', 'New Category Type was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.category.index')->withInput();
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.category.create')->withInput();
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
        $category = Category::find($id);
        if (isset($category)) {
            return view('admin.category.edit', compact('category'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.category.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CommitteeTypeRequest $request
     * @param  int $id
     * @return void
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $request->input('category');

        $updatecategory = Category::find($id);
        $updatecategory->category = $category;
        $saveCategory = $updatecategory->save();

        if (isset($saveCategory)) {
            $request->session()->flash('flash_notification.message', 'Category was successfully updated.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.category.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.category.index');
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
        $category = Category::find($id);
        if (isset($category)) {

            $operationStatus = $category->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Category Type was successfully inactivated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.category.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.category.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.category.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $categoryList = Category::onlyTrashed()->get();
        return view('admin.category.deleted', compact('categoryList'));
    }

    /**
     * Restore the selected resource
     *
     * @param CommitteeTypeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(CategoryRequest $request, $id)
    {

        $category = Category::withTrashed()->find($id);
        if (isset($category)) {

            $operationStatus = $category->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Category successfully Activated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.category.deleted');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.category.deleted');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.category.deleted');
        }
    }
}
