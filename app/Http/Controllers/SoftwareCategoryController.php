<?php

namespace App\Http\Controllers;

use App\Models\SoftwareCategory;
use Illuminate\Http\Request;

class SoftwareCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('softwareCategory/index', [
          "title" => "Software Category",
          "categories" => SoftwareCategory::all()  
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('softwareCategory/create', [
        "title" => "Add Software Category"
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'name' => 'required|max:255|unique:software_categories',
          'is_over_usage' => 'required'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);

        SoftwareCategory::create($validatedData);
        return redirect('/softwareCategory')->with('success', 'Software category data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SoftwareCategory  $softwareCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SoftwareCategory $softwareCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SoftwareCategory  $softwareCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SoftwareCategory $softwareCategory)
    {
        return view('/softwareCategory/edit', [
          "title" => "Edit Software Category",
          "category" => $softwareCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SoftwareCategory  $softwareCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoftwareCategory $softwareCategory)
    {
        $validatedData = $request->validate([
          'name' => 'required|max:255',
          'is_over_usage' => 'required'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);

        SoftwareCategory::where('id', $softwareCategory->id)->update($validatedData);
        return redirect('/softwareCategory')->with('success', 'Software category data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoftwareCategory  $softwareCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoftwareCategory $softwareCategory)
    {
        SoftwareCategory::destroy($softwareCategory->id);
        return redirect('/softwareCategory')->with('success', 'Software category data successfully deleted');
    }
}
