<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\HardwareCategory;
use Illuminate\Http\Request;

class HardwareCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hardwareCategory/index', [
            "title" => "Hardware Category",
            "categories" => HardwareCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hardwareCategory/create', [
            "title" => "Add Hardware Category"
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
				'name' => 'required|max:255|unique:hardware_categories'	
			]);

			$validatedData['name'] = ucfirst($validatedData['name']);

			HardwareCategory::create($validatedData);

			return redirect('/hardwareCategory')->with('success', 'Hardware category data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function show(HardwareCategory $hardwareCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(HardwareCategory $hardwareCategory)
    {
			return view('hardwareCategory/edit', [
				"title" => "Edit Hardware Category",
				"category" => $hardwareCategory
			]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HardwareCategory $hardwareCategory)
    {
			$validatedData = $request->validate([
				'name' => 'required|max:255'
			]);

			$validatedData['name'] = ucfirst($validatedData['name']);

			HardwareCategory::where('id', $hardwareCategory->id)->update($validatedData);
			return redirect('/hardwareCategory')->with('success', 'Hardware category data successfully updated');
		}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(HardwareCategory $hardwareCategory)
    {
        HardwareCategory::destroy($hardwareCategory->id);
				return redirect('/hardwareCategory')->with('success', 'Hardware category data successfully deleted');
    }
}
