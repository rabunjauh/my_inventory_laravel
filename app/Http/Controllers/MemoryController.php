<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class MemoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('memory/index', [
            "title" => "Memory Data",
            "memories" => Memory::with(Manufacturer::class)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memory/create', [
            "title" => "Add Memory Data",
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
            'type' => 'required|max:255',
            'module' => 'required|max:255',
            'capacity' => 'required|max:255',
            'manufacturer_id' => 'required',
            'description' => 'nullable',
        ]);

        Memory::create($validatedData);
        return redirect('/memory')->with('success', 'Memory data successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function show(Memory $memory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function edit(Memory $memory)
    {
        return view('memory/edit', [
            "title" => "Edit Memory Data",
            "manufacturers" => Manufacturer::all(),
            "memory" => $memory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memory $memory)
    {
        $validatedData = $request->validate([
            'type' => 'required|max:255',
            'module' => 'required|max:255',
            'capacity' => 'required|max:255',
            'manufacturer_id' => 'required',
            'description' => 'nullable',
        ]);

        Memory::where('id', $memory->id)->update($validatedData);
        return redirect('/memory')->with('success', 'Memory data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memory $memory)
    {
        Memory::destroy($memory->id);
        return redirect('/memory')->with('success', 'Memory data successfully deleted');
    }
}
