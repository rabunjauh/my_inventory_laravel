<?php

namespace App\Http\Controllers;

use App\Models\GraphicCard;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class GraphicCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('graphicCard/index', [
            "title" => "Graphic Card Data",
            "graphicCards" => GraphicCard::with(['manufacturer'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('graphicCard/create', [
            "title" => "Add Graphic Card",
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
            'capacity' => 'required|max:255',
            'model' => 'required|max:255',
            'manufacturer_id' => 'required',
            'description' => 'nullable'
        ]);

        GraphicCard::create($validatedData);
        return redirect('/graphicCard')->with('success', 'Graphic card data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GraphicCard  $graphicCard
     * @return \Illuminate\Http\Response
     */
    public function show(GraphicCard $graphicCard)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GraphicCard  $graphicCard
     * @return \Illuminate\Http\Response
     */
    public function edit(GraphicCard $graphicCard)
    {
        return view('graphicCard/edit', [
            "title" => "Edit Graphic Card Data",
            "manufacturers" => Manufacturer::all(),
            "graphicCard" => $graphicCard
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GraphicCard  $graphicCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GraphicCard $graphicCard)
    {
        $validatedData = $request->validate([
            'type' => 'required|max:255',
            'capacity' => 'required|max:255',
            'model' => 'required|max:255',
            'manufacturer_id' => 'required',
            'description' => 'nullable'
        ]);

        GraphicCard::where('id', $graphicCard->id)->update($validatedData);
        return redirect('/graphicCard')->with('success', 'Graphic card data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GraphicCard  $graphicCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(GraphicCard $graphicCard)
    {
        GraphicCard::destroy($graphicCard->id);
        return redirect('/graphicCard')->with('success', 'Graphic card data successfully deleted');
    }
}
