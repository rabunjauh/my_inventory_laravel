<?php

namespace App\Http\Controllers;

use App\Models\GraphicCard;
use App\Models\Hardware;
use App\Models\HardwareCategory;
use App\Models\HardwareModel;
use App\Models\HardwareType;
use App\Models\Manufacturer;
use App\Models\Memory;
use App\Models\Processor;
use App\Models\Storage;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    /**
     * Display a listin]]g of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hardware/index', [
            "title" => "Hardware Data",
            "hardwares" => Hardware::with([
                                            'hardwareCategory', 
                                            'graphicCard', 
                                            'hardwareModel',
                                            'hardwareType',
                                            'manufacturer',
                                            'memory',
                                            'processor',
                                            'storage'
                                        ])
                                        ->get()
        ]);

        // return view('hardware/index', [
        //     "title" => "Hardware",
        //     "hardwares" => Hardware::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hardware/create', [
            "title" => "Add Hardware",
            "categories" => HardwareCategory::all(),
            "graphicCards" => GraphicCard::all(),
            "models" => HardwareModel::all(),
            "types" => HardwareType::all(),
            "manufacturers" => Manufacturer::all(),
            "memories" => Memory::all(),
            "processors" => Processor::all(),
            "storages" => Storage::all()
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
            'code' => 'required|max:255|numeric|unique:hardware',
            'hardware_category_id' => 'required',
            'name' => 'required|max:255',
            'manufacturer_id' => 'required|max:255',
            'serial_number' => 'required|max:255',
            'status' => 'required',
            // 'warranty_start' => 'nullable',
            // 'warranty_end' => 'nullable',
            'description'=> 'nullable',
            'image' => 'nullable',
            'image_format' => 'nullable|alpha',
            'remark' => 'nullable',
            'service_code' => 'nullable',
            'hardware_type_id' => 'required',
            'hardware_model_id' => 'required',
            'processor_id' => 'required',
            'memory_id' => 'required',
            'graphic_card_id' => 'required',
            'storage_id' => 'required',
            'computer_name' => 'required',
        ]); 

        $validatedData['name'] = ucwords($validatedData['name']);
        $validatedData['serial_number'] = strtoupper($validatedData['serial_number']);
        $validatedData['computer_name'] = strtoupper($validatedData['computer_name']);

        Hardware::create($validatedData);
        return redirect('/hardware')->with('success', 'Hardware data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function show(Hardware $hardware)
    {
        //    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function edit(Hardware $hardware)
    {
        return view('hardware/edit', [
            "title" => "Add Hardware",
            "categories" => HardwareCategory::all(),
            "graphicCards" => GraphicCard::all(),
            "models" => HardwareModel::all(),
            "types" => HardwareType::all(),
            "manufacturers" => Manufacturer::all(),
            "memories" => Memory::all(),
            "processors" => Processor::all(),
            "storages" => Storage::all(),
            "hardware" => $hardware
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hardware $hardware)
    {
        $validatedData = $request->validate([
            'code' => 'required|max:255|numeric',
            'hardware_category_id' => 'required',
            'name' => 'required|max:255',
            'manufacturer_id' => 'required|max:255',
            'serial_number' => 'required|max:255',
            'status' => 'required',
            'warranty_start' => 'nullable',
            'warranty_end' => 'nullable',
            'description'=> 'nullable',
            'image' => 'nullable',
            'image_format' => 'nullable|alpha',
            'remark' => 'nullable',
            'service_code' => 'nullable',
            'hardware_type_id' => 'required',
            'hardware_model_id' => 'required',
            'processor_id' => 'required',
            'memory_id' => 'required',
            'graphic_card_id' => 'required',
            'storage_id' => 'required',
            'computer_name' => 'required',
        ]); 

        $validatedData['name'] = ucwords($validatedData['name']);
        $validatedData['serial_number'] = strtoupper($validatedData['serial_number']);
        $validatedData['computer_name'] = strtoupper($validatedData['computer_name']);

        Hardware::where('id', $hardware->id)->update($validatedData);
        return redirect('/hardware')->with('success', 'Hardware data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hardware $hardware)
    {
        Hardware::destroy($hardware->id);
        return redirect('/hardware')->with('success', 'Hardware data successfully deleted');
    }
}
