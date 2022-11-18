<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Processor;
use Illuminate\Http\Request;

class ProcessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('processor/index', [
            "title" => "Processor Data",
            "processors" => Processor::with(['manufacturer'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('processor/create', [
        "title" => "Add Processor",
        "manufacturers" => Manufacturer::all()
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
            'model_no' => 'required|max:255|unique:processors',
            'manufacturer_id' => 'required',
            'core' => 'required',
            'frequency' => 'required|max:255',
            'memory_support' => 'required|max:255'
        ]);

        $validatedData['model_no'] = ucwords($validatedData['model_no']);

        Processor::create($validatedData);
        return redirect('/processor')->with('success', 'Processor data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\processor  $processor
     * @return \Illuminate\Http\Response
     */
    public function show(processor $processor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\processor  $processor
     * @return \Illuminate\Http\Response
     */
    public function edit(processor $processor)
    {
        return view('processor/edit', [
            "title" => "Edit Processor",
            "manufacturers" => Manufacturer::all(),
            "processor" => $processor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\processor  $processor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, processor $processor)
    {
        $validatedData = $request->validate([
            'model_no' => 'required|max:255',
            'manufacturer_id' => 'required',
            'core' => 'required',
            'frequency' => 'required|max:255',
            'memory_support' => 'required|max:255'
        ]);

        $validatedData['model_no'] = ucwords($validatedData['model_no']);

        Processor::where('id', $processor->id)->update($validatedData);
        return redirect('/processor')->with('success', 'Processor data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\processor  $processor
     * @return \Illuminate\Http\Response
     */
    public function destroy(processor $processor)
    {
        Processor::destroy($processor->id);
        return redirect('/processor')->with('success', 'Processor data successfully deleted');
    }
}
