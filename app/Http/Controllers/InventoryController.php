<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\Inventory;
use App\Models\InventoryDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory/index', [
            "title" => "Inventory Data",
            "inventories" => Inventory::with(['hardware', 'supplier'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory/create', [
            "title" => "Inventory In",
            "suppliers" => Supplier::all()
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
        return view('inventory/details', [
            "title" => "Inventory Detail"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        return view('inventory/show', [
            "title" => "Inventory Detail",
            "inventory" => $inventory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function inventory_ajax() {
        return DataTables::of(Inventory::with([
            'hardware',
            'supplier'])
        ->get())
        ->addIndexColumn()
        ->addColumn('action', 'inventory/action')
        ->toJson();
    }

    // public function inventoryDetailAjax($inventoryId) {
    public function inventoryDetailAjax($inventoryId) {
        return DataTables::of(InventoryDetail::with([
            'hardware',
            'inventory'
        ])
        ->where('inventory_id', $inventoryId)
        ->get())
        ->addIndexColumn()
        ->toJson();
    }
}