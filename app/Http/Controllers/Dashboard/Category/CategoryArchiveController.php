<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::onlyTrashed()->paginate('3');

        return view('dashboard.Category.caregoryArchive',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {


        $category= Category::withTrashed()->where('id', $id)->restore();

        return redirect()->route('dashboard.Archive.index')->with(['success'=>'تم الغاء ارشفه القسم بنجاح']);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function forceDelete($id)
    {
        // Permanently delete a soft deleted post
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('dashboard.Archive.index')->with('success', __('site.deleted_successfully'));
    }
}
