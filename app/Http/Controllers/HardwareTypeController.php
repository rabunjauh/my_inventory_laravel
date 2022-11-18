<?php

namespace App\Http\Controllers;

use App\Models\hardwareType;
use Illuminate\Http\Request;

class HardwareTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hardwareType/index', [
            "title" => "Hardware Type Data",
            "types" => HardwareType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hardwareType/create', [
            "title" => "Add Hardware Type"
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
            'name' => 'required|max:255|unique:hardware_types'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);

        HardwareType::create($validatedData);
        return redirect('/hardwareType')->with('success', 'Hardware type data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hardwareType  $hardwareType
     * @return \Illuminate\Http\Response
     */
    public function show(hardwareType $hardwareType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hardwareType  $hardwareType
     * @return \Illuminate\Http\Response
     */
    public function edit(hardwareType $hardwareType)
    {
        return view('/hardwareType/edit', [
            "title" => "Add Hardware type",
            "type" => $hardwareType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hardwareType  $hardwareType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hardwareType $hardwareType)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);

        HardwareType::where('id', $hardwareType->id)->update($validatedData);
        return redirect('/hardwareType')->with('success', 'Hardware type data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hardwareType  $hardwareType
     * @return \Illuminate\Http\Response
     */
    public function destroy(hardwareType $hardwareType)
    {
        HardwareType::destroy($hardwareType->id);
        return redirect('/hardwareType')->with('success', 'Hardware type data successfully deleted');
    }
}
