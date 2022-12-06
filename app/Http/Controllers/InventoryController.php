<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\Inventory;
use App\Models\InventoryDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;                        
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

        $validatedInventory = $request->validate([
            'do_date' => 'required|date',
            'do_no' => 'required|numeric',
            'inventory_date' => 'required|date',
            'supplier_id' => 'required|numeric',
        ]);

        $validatedInventoryDetails = $request->validate([
            'inventory_id.*' => 'required|numeric', 
            'hardware_id.*' => 'required|numeric|distinct',
            'quantity.*' => 'required|numeric|distinct'
        ]);

        $inventory = Inventory::create($validatedInventory);
        if($inventory) {
            for($i = 0; $i < count($request->input('hardware_id')); $i++) {
                $validatedInventoryDetails['inventory_id'] = $inventory->id;
                $validatedInventoryDetails['hardware_id'] = $request->input('hardware_id')[$i];
                $validatedInventoryDetails['quantity'] = $request->input('quantity')[$i];
                InventoryDetail::create($validatedInventoryDetails);
            }
        }


        // $input['do_data'] = $request->input('do_date');
        // $input['do_no'] = $request->input('do_no');
        // $input['inventory_date'] = $request->input('inventory_date');
        // $input['supplier_id'] = $request->input('supplier_id');

        // $inventory = Inventory::create($input);
        // if($inventory->id) {
        //     for($i = 0; $i < count($request->input('hardware_id')); $i++) {
        //         // $validatedInventoryDetails['inventory_id'][$i] = $inventory->id;
        //         $multiple_input['inventory_id'] = $inventory->id;
        //         $multiple_input['hardware_id'] = $request->input('hardware_id')[$i];
        //         $multiple_input['quantity'] = $request->input('quantity')[$i];
        //         InventoryDetail::create($multiple_input);
        //     }
        //     // foreach ($validatedInventoryDetails as $key => $value) {
        //     //     var_dump($value);
        //         // InventoryDetail::create($value);
        //     // }
        // }

        

        // foreach($request->input('inventory_id') as $key => $value) {
        //     DB::transaction(function() {
        //         Inventory::create($validatedData);
        //     });
        // }

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
        DB::transaction(function () {
            DB::update('update users set votes = 1');
         
            DB::delete('delete from posts');
        });
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