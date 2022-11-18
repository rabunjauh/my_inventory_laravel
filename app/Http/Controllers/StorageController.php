<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('storage/index',[
            "title" => "Storage Data",
            "storages" => Storage::with(['manufacturer'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storage/create', [
            "title" => "Add Storage",
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
            'size' => 'required|max:255',
            'capacity' => 'required|max:255',
            'manufacturer_id' => 'required',
            'technology' => 'required|max:255',
            'type' =>  'required|max:255'
        ]);
        $validatedData['capacity'] = ucwords($validatedData['capacity']);
        $validatedData['technology'] = ucwords($validatedData['technology']);

        Storage::create($validatedData);
        return redirect('/storage')->with('success', 'Storage data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(Storage $storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(Storage $storage)
    {
        return view('storage/edit', [
            "title" => "Edit Storage",
            "manufacturers" =>  Manufacturer::all(),
            "storage" => $storage
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storage $storage)
    {
        $validatedData = $request->validate([
            'size' => 'required|max:255',
            'capacity' => 'required|max:255',
            'manufacturer_id' => 'required',
            'technology' => 'required|max:255',
            'type' =>  'required|max:255'
        ]);
        $validatedData['capacity'] = ucwords($validatedData['capacity']);
        $validatedData['technology'] = ucwords($validatedData['technology']);

        Storage::where('id', $storage->id)->update($validatedData);
        return redirect('/storage')->with('success', 'Storage data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {
        Storage::destroy($storage->id);
        return redirect('/storage')->with('success', 'Storage data successfully deleted');
    }
}
