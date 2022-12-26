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
        // get update inventory result
        $updateInventory = Inventory::where('id', $inventory->id)->update($validatedInventory);
        // if result is true 
        if($updateInventory) {
            // get column id from inventoryDetails where inventory_id = $inventory_id
            $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get(['id']);
            // loop for as many as input form quantity($validatedInventoryDetails)
            for($i = 0; $i < count($validatedInventoryDetails['hardware_id']); $i++) {
                // get first row from inventoryDetail where hardware_id = hardware_id from input form and assign to $exist variable 
                $exist = InventoryDetail::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                // if exist result is true / available
                if($exist) {
                    /* update quantity of inventoryDetail where hardware_id = hardware_id from input form and where 
                    inventory_id = $inventory->id then get the result and assign into $inventoryDeatilUpdate variable */  
                    $inventoryDetailUpdate = InventoryDetail::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])
                                                                ->where('inventory_id', $inventory->id)
                                                                ->update(['quantity' => $validatedInventoryDetails['quantity'][$i]]);
                    // if $inventoryDeatilUpdate is successfull
                    if($inventoryDetailUpdate) {
                        // get first row of ItemStock where hardware_id = hardware_id from input form then assign into $stock variable
                        $stock = ItemStock::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                        // if $stock is true / available
                        if($stock) {
                            // assign hardware_id from input form n into $updateStock array
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            /* Subtrack quantity from input form n with quantity from inventory_details table where
                            hardware_id = hardware_id from input form then add with existing stock from item_stocks 
                            table where hardware_id = hardware_id from input form then assign into $updateStock array */
                            $updateStock['stock'] = ($validatedInventoryDetails['quantity'][$i] - $exist->quantity) + $stock->stock;
                            /* update existing row inside item_stocks table where hardware_id = hardware id from input form n with
                            // value from $updateStock array(from input form n data) */
                            ItemStock::where('hardware_id', $updateStock['hardware_id'])->update($updateStock);
                        // if $stock is not true / not available
                        } else {
                            // assign hardware_id & quantity from input form n into $updateStock array
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            $updateStock['stock'] = $validatedInventoryDetails['quantity'][$i];
                            // insert $update stock array to new row in item_stocks table
                            ItemStock::create($updateStock);
                        }
                    }
                // if $exist result is false / not available
                } else {
                    // assign $inventory->id, hardware_id & quantity from input from n to $create array
                    $create['inventory_id'] = $inventory->id;
                    $create['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                    $create['quantity'] =$validatedInventoryDetails['quantity'][$i];
                    // insert new $create array to new row in inventory_details table get insert result then assign into $inventoryDetail variable
                    $inventoryDetail = InventoryDetail::create($create);
                    // if insert new row in inventory_details table success
                    if($inventoryDetail) {
                        // get first row from item_stock table where hardware_id = hardware_id from input form n then assign to $stock variable
                        $stock = ItemStock::where('hardware_id', $validatedInventoryDetails['hardware_id'][$i])->first();
                        // if $stock result is true / available
                        if($stock) {
                            // assign hardware_id from input form n into $updateStock array
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            // add existing stock from item_stocks table with quantity from input form n then assign into $updateStock array
                            $updateStock['stock'] = $stock->stock + $validatedInventoryDetails['quantity'][$i];
                            /* update existing row inside item_stocks table where hardware_id = hardware id from input form n with
                            // value from $updateStock array(from input form n data) */
                            ItemStock::where('hardware_id', $stock->hardware_id)->update($updateStock);
                        // if $stock result is false / not available
                        } else {
                            // assign hardware_id & quantity from input form n into $updateStock array
                            $updateStock['hardware_id'] = $validatedInventoryDetails['hardware_id'][$i];
                            $updateStock['stock'] = $validatedInventoryDetails['quantity'][$i];
                            // insert $update stock array to new row in item_stocks table
                            ItemStock::create($updateStock);
                        }
                    }
                }
            }
            /* Delete * from inventory_details table where hardware_id != $validatedInventoryDetails array of hardware_id and
            inventor_id = $inventory->id then assign the result into $deleteInventoryDetails variable */
            $deleteInventoryDetails = InventoryDetail::whereNotIn('hardware_id', $validatedInventoryDetails['hardware_id'])->where('inventory_id', $inventory->id)->get();
            // if $deleteInventoryDetails result is true / available
            if($deleteInventoryDetails){
                // loop every element in $deleteInventoryDetails array
                foreach($deleteInventoryDetails as $deleteInventoryDetail) {
                    // get single row from item_stocks table where hardware_id = hardware_id from input form then assign result into $stock variable
                    $stock = ItemStock::where('hardware_id', $deleteInventoryDetail->hardware_id)->first();
                    // if $stock result is true / available
                    if($stock) {
                        // Assign hardware_id from input form n to $updateStock array
                        $updateStock['hardware_id'] = $deleteInventoryDetail->hardware_id;
                        // Subtract existing stock in item_stocks table with deleted data from input form n
                        $updateStock['stock'] = $stock->stock - $deleteInventoryDetail->quantity;
                        // Update item_stocks table where hardware_id = deleted hardware_id with data inside $updateStock array
                        ItemStock::where('hardware_id', $stock->hardware_id)->update($updateStock);
                    }
                    // Delete from inventory_details where hardware_id = deleted item from input form n
                    InventoryDetail::where('hardware_id', $deleteInventoryDetail->hardware_id)->where('inventory_id', $inventory->id)->delete();
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
        // Delete from inventories where inventory_id = $inventory->id and assign result into $deleted variable
        $deleted = Inventory::destroy($inventory->id);
        // If delete result is true / success
        if($deleted) {
            // Get inventory_details where inventory_id = $inventory->id and assign into $inventoryDetails variable
            $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get();
            // Loop every element inside $inventoryDetails array
            foreach($inventoryDetails as $inventoryDetail) {
                // Get single row from item_stocks table where hardware_id = inventory_detail->hardware_id
                $stock = ItemStock::where('hardware_id', $inventoryDetail->hardware_id)->first();
                // if $stock result is true / available
                if($stock) {
                    // Assign hardware_id from input form n to $updateStock array
                    $updateStock['hardware_id'] = $inventoryDetail->hardware_id;
                    // Subtract existing stock in item_stocks table with deleted data from input form n
                    $updateStock['stock'] = $stock->stock - $inventoryDetail->quantity;
                    // Update item_stocks table where hardware_id = deleted hardware_id with data inside $updateStock array
                    ItemStock::where('hardware_id', $stock->hardware_id)->update($updateStock);
                }
            }
        }
        // Delete all from inventory_details where inventory_id = $inventory->id
        InventoryDetail::where('inventory_id', $inventory->id)->delete();
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