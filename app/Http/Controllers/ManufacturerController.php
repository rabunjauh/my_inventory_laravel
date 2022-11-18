<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/manufacturer/index', [
            "title" => "Manufacturer Data",
            "manufacturers" => Manufacturer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/manufacturer/create', [
            "title" => "Add Manufacturer",
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
            'name' => 'required|max:255|unique:manufacturers'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);

        Manufacturer::create($validatedData);
        return redirect('/manufacturer')->with('success', 'Manufacturer data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(manufacturer $manufacturer)
    {
        return view('/manufacturer/edit', [
            "title" => "Add Manufacturer",
            "manufacturer" => $manufacturer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, manufacturer $manufacturer)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);

        Manufacturer::where('id', $manufacturer->id)->update($validatedData);
        return redirect('/manufacturer')->with('success', 'Manufacturer data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(manufacturer $manufacturer)
    {
        Manufacturer::destroy($manufacturer->id);
        return redirect('/manufacturer')->with('success', 'Manufacturer data successfully deleted');
    }
}
