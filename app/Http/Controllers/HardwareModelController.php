<?php

namespace App\Http\Controllers;

use App\Models\HardwareModel;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class HardwareModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hardwareModel/index', [
            "title" => "Hardware Model Data",
            "hardwareModels" => HardwareModel::with(['manufacturer'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hardwareModel/create', [
            "title" => "Add Hardware Model",
            "manufacturers" =>  Manufacturer::all(),
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
            'name' => 'required|max:255',
            'manufacturer_id' => 'required'
        ]);

        HardwareModel::create($validatedData);
        return redirect('/hardwareModel')->with('success', 'Hardware model data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HardwareModel  $hardwareModel
     * @return \Illuminate\Http\Response
     */
    public function show(HardwareModel $hardwareModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HardwareModel  $hardwareModel
     * @return \Illuminate\Http\Response
     */
    public function edit(HardwareModel $hardwareModel)
    {
        return view('hardwareMemory/edit', [
            "title" => "Edit Hardware Model",
            "manufacturers" => Manufacturer::all(),
            "hardwareModel" => $hardwareModel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HardwareModel  $hardwareModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HardwareModel $hardwareModel)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'manufacturer_id' => 'required'
        ]);

        HardwareModel::where('id', $hardwareModel->id)->update($validatedData);
        return redirect('/hardwareModel')->with('success', 'Hardware model data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HardwareModel  $hardwareModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(HardwareModel $hardwareModel)
    {
        HardwareModel::destroy($hardwareModel->id);
        return redirect('/hardwareModel')->with('success', 'Hardware model data successfully deletd');
    }
}
