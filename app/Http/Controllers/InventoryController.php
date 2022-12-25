<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\Inventory;
use App\Models\InventoryDetail;
use App\Models\itemStock;
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
            'hardware_id.*' => 'required|numeric',
            'quantity.*' => 'required|numeric'
        ]);

        // get inventory insert result
        $inventory = Inventory::create($validatedInventory);
        // if the result is true
        if($inventory) {
            // if data from form is true
            if($request->input('hardware_id')){
                // loop as form input quantity
                for($i = 0; $i < count($request->input('hardware_id')); $i++) {
                    // init input data to $create
                    $create['inventory_id'] = $inventory->id;
                    $create['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                    $create['quantity'] =$validatedInventoryDetails['quantity'][$i]; 
                    // insert to inventory_details and get the result
                    $inventoryDetail = InventoryDetail::create($create);
                    // if the result is true
                    if($inventoryDetail) {
                        // get from item_stocks result
                        $stock = ItemStock::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                        // if the result is true
                        if($stock) {
                                $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                                $updateStock['stock'] = $stock->stock + $validatedInventoryDetails['quantity'][$i];
                                // update quantity of existing data in item_stocks with quantity from input form 
                                ItemStock::where('hardware_id', $stock->hardware_id)->update($updateStock);
                        // if the result is false 
                        } else {
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            $updateStock['stock'] = $validatedInventoryDetails['quantity'][$i];
                            // insert new data from input form
                            ItemStock::create($updateStock);
                        }
                    }
                }
                return redirect('/inventory')->with('success', 'Inventory data successfully updated');
            } else {
                return redirect('/inventory/create')->with('failed', 'At least 1 item must be selected!');
            }
        }
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
        return view('inventory/edit', [
            "title" => "Edit Inventory",
            "suppliers" => Supplier::all(),
            "inventory" => $inventory
        ]);
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
        $validatedInventory = $request->validate([
            'do_date' => 'required|date',
            'do_no' => 'required|numeric',
            'inventory_date' => 'required|date',
            'supplier_id' => 'required|numeric',
        ]);

        $validatedInventoryDetails = $request->validate([
            'inventory_id.*' => 'required|numeric', 
            'hardware_id.*' => 'required|numeric',
            'quantity.*' => 'required|numeric'
        ]);

        $updateInventory = Inventory::where('id', $inventory->id)->update($validatedInventory);
        if($updateInventory) {
            $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get(['id']);
            for($i = 0; $i < count($validatedInventoryDetails['hardware_id']); $i++) {
                $exist = InventoryDetail::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                if($exist) {
                    $inventoryDetailUpdate = InventoryDetail::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])
                                                                ->where('inventory_id', $inventory->id)
                                                                ->update(['quantity' => $validatedInventoryDetails['quantity'][$i]]);
                    if($inventoryDetailUpdate) {
                        $stock = ItemStock::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                        if($stock) {
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            $updateStock['stock'] = ($validatedInventoryDetails['quantity'][$i] - $exist->quantity) + $stock->stock;
                            ItemStock::where('hardware_id', $updateStock['hardware_id'])->update($updateStock);
                        } else {
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            $updateStock['stock'] = $validatedInventoryDetails['quantity'][$i];
                            ItemStock::create($updateStock);
                        }
                    }
                } else {
                    $create['inventory_id'] = $inventory->id;
                    $create['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                    $create['quantity'] =$validatedInventoryDetails['quantity'][$i];
                    $inventoryDetail = InventoryDetail::create($create);
                    if($inventoryDetail) {
                        $stock = ItemStock::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                        if($stock) {
                                $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                                $updateStock['stock'] = $stock->stock + $validatedInventoryDetails['quantity'][$i];
                                ItemStock::where('hardware_id', $stock->hardware_id)->update($updateStock);
                        } else {
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            $updateStock['stock'] = $validatedInventoryDetails['quantity'][$i];
                            ItemStock::create($updateStock);
                        }
                    }
                }
            }

            $deleteInventoryDetails = InventoryDetail::whereNotIn('hardware_id', $validatedInventoryDetails['hardware_id'])->where('inventory_id', $inventory->id)->get();
            if($deleteInventoryDetails){
                foreach($deleteInventoryDetails as $deleteInventoryDetail) {
                    $stock = ItemStock::where('hardware_id', $deleteInventoryDetail->hardware_id)->first();
                    if($stock) {
                        $updateStock['stock'] = $stock->stock + $deleteInventoryDetail->quantity;
                        ItemStock::where('hardware_id', $updateStock['hardware_id'])->update($updateStock);
                    }
                    InventoryDetail::where('hardware_id', $deleteInventoryDetail->hardware_id)->delete();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $deleted = Inventory::destroy($inventory->id);
        if($deleted) {
            InventoryDetail::where('inventory_id', $inventory->id)->delete();
        }
        return redirect('/inventory')->with('success', 'Inventory data successfully deleted');
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

    // get inventoryDetailAjax by inventory_id
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

    // get inventoryDetailAjax by hardware_id
    public function inventoryDetailAjaxByHardwareId($hardware_id) {
        return DataTables::of(InventoryDetail::with([
            'hardware',
            'inventory'
        ])
        ->where('hardware_id', $hardware_id)
        ->get())
        ->addIndexColumn()
        ->toJson();
    }
}