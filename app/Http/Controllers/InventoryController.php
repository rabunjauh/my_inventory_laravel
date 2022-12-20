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
            if($request->input('hardware_id')){
                for($i = 0; $i < count($request->input('hardware_id')); $i++) {
                    $validatedInventoryDetails['inventory_id'] = $inventory->id;
                    $validatedInventoryDetails['hardware_id'] = $request->input('hardware_id')[$i];
                    $validatedInventoryDetails['quantity'] = $request->input('quantity')[$i];
                    InventoryDetail::create($validatedInventoryDetails);
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
            $items = $request->input('hardware_id');
            var_dump($items);
            echo "<br>";
            $quantity = $request->input('quantity');
            // $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get();
            $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get(['id']);
            // $InventoryDetailsIds = [];
            // foreach($inventoryDetails as $inventoryDetail) {
            //     array_push($InventoryDetailsIds, $inventoryDetail->id);
            // }
            // if(count($items) >= count($inventoryDetails)) {
                for($i = 0; $i < count($items); $i++) {
                    echo $items[$i];
                    echo "<br>";
                    // for($j = 0; $j < count($inventoryDetails); $j++) {
                    //     if($items[$i] == $inventoryDetails[$j]->id) {
                    //         InventoryDetail::where('id', $inventoryDetails[$j]->id)->update(['quantity' => $quantity[$i]]);
                    //     }                            
                    // }
                    $exist = InventoryDetail::where('hardware_id', $items[$i])->first();
                    if($exist) {
                        // for($j = 0; $j < count($inventoryDetails); $j++) {
                        //     if($items[$i] == $inventoryDetails[$j]->id) {
                        //         InventoryDetail::where('id', $inventoryDetails[$j]->id)->update(['quantity' => $quantity[$i]]);
                        //     }                            
                        // }
                        
                                InventoryDetail::where('hardware_id', $items[$i])->update(['quantity' => $quantity[$i]]);
                        // echo $items[$i] . "is exist <br>";
                    } else {
                        // echo $items[$i] . "is not exist";
                        $validatedInventoryDetails['inventory_id'] = $inventory->id;
                        $validatedInventoryDetails['hardware_id'] = $items[$i];
                        $validatedInventoryDetails['quantity'] = $quantity[$i];
                        var_dump($validatedInventoryDetails);
                        echo "<br>";
                        InventoryDetail::create($validatedInventoryDetails);
                    }
                }
            // } 
            $deleteInventoryDetails = InventoryDetail::whereNotIn('hardware_id', $items)->get();
            var_dump($deleteInventoryDetails);
            if($deleteInventoryDetails){
                foreach($deleteInventoryDetails as $deleteInventoryDetail) {
                    InventoryDetail::where('id', $deleteInventoryDetail->id)->delete();
                }
            }

            // echo "<br>";
            // var_dump($InventoryDetailsIds);
            // echo "<br>";
            // var_dump($items);
            // echo "<br>";
            // var_dump($inventoryDetails);
            // echo "<br>";

            // var_dump(array_diff($items, $inventoryDetails));
            // for($i = 0; $i < count($items); $i++) {
            //     echo "i:" . $i . "<br>";
            //     for($j = 0; $j < count($inventoryDetails); $j++) {
            //         echo "j:" . $j;
            //         // var_dump($inventoryDetails[$j]);
            //         if($items[$i] == $inventoryDetails[$j]['id']) {
            //             // InventoryDetail::where('id', $inventoryDetails[$j]->id)->update(['quantity' => $quantity[$i]]);
            //             // echo "items id" . $items[$i] . " " . $i . " & inventoryDetails id" . $inventoryDetails[$j]['id'] . " " . $j . " is identical </br>";
            //         } else {
            //         }
            //     }
            //     echo "<br>";
            //     if(count($items) > count($inventoryDetails)) {
                    
            //     }
            //     // if(count($items) > count($inventoryDetails)) {
            //     //     echo $items[$i] . "inserted";
            //     //     // $validatedInventoryDetails[$i]['hardware_id'] = $items[$i];
            //     //     // $validatedInventoryDetails[$i]['']
            //     //     // InventoryDetail::create()
            //     // }
            //     // InventoryDetail::whereNotIn('id', $items)->delete();
            // }
























            // if(count($items) >= count($inventoryDetails)) {
                // foreach($items as $itemKey => $item) {
                //     foreach($inventoryDetails as $inventoryDetailsKey => $inventoryDetail) {
                //         if($item == $inventoryDetail->id){
                //             // InventoryDetail::where('id', $inventoryDetail->id)->update(['quantity' => $quantity[$itemKey]]);
                //             echo "items id" . $item . " " . $itemKey . " & inventoryDetails id" . $inventoryDetail['id'] . " " . $inventoryDetailsKey . " is identical </br>";
                //         }
                //             echo "items id" . $item . " " . $itemKey . " & inventoryDetails id" . $inventoryDetail['id'] . " " . $inventoryDetailsKey . " is not identical </br>";
                //         // InventoryDetail::create();
                //     }
                //     echo "<br>";
                //     // var_dump($item);
                //     echo "<br>";
                //     // $tes = InventoryDetail::where('id', $item)->get();
                //     // if(!$tes){
                //     //     echo $item . " tidak ada di dalam table inventory Detail";
                //     // }
                //     // $tes = InventoryDetail::where('id', $items)->get();
                //     //         if(count($tes) <= 0){
                //     //             echo " tidak ada di dalam table inventory Detail";
                //     //         } else {
                //     //             echo "tes";
                //     //         }
                // }
                // InventoryDetail::whereNotIn('id', $items)->delete();
            // }

                // $items = $request->input('hardware_id')[0];
                // $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get();
                // foreach($inventoryDetails as $inventoryDetail) {
                //     if($items == $inventoryDetail->id) {
                //         InventoryDetail::where('id', $inventoryDetail->id)->update(['quantity' => 1]);
                //     } else {
                //         InventoryDetail::destroy($inventoryDetail->id);
                //     }
                // }

                            // echo $items = $request->input('hardware_id')[0];
                            // $inventoryDetails = InventoryDetail::where('inventory_id', $inventory->id)->get();
                            // foreach($inventoryDetails as $inventoryDetail) {
                            //     if($items == $inventoryDetail->id) {
                            //         InventoryDetail::where('id', $inventoryDetail->id)->update(['quantity' => 1]);
                            //     } else {
                            //         InventoryDetail::destroy($inventoryDetail->id);
                            //     }
                            // }
            


















        //     if($items){
        //         if(count($items) < count($inventoryDetail) || count($items) == count($inventoryDetail)) {
        //             foreach($items as $key => $currentItem){
        //                 echo $items[$key];
        //                 $prevInventoryDetail = InventoryDetail::where('hardware_id', $items[$key])->get();
        //                 var_dump($prevInventoryDetail);
        //                 // if(!$prevInventoryDetail) {
        //                 //    $currentItem->name
        //                 // } else {
        //                 //     echo "exist";
        //                 // }
        //                 // foreach($prevInventoryDetail as $item) {
        //                 //     $itemExist = InventoryDetail::where('id', $item->id)->first();
        //                 //     if(!$itemExist){
        //                         // echo "not exist";
        //                     //     $validatedInventoryDetails['inventory_id'] = $inventory->id;
        //                     //     $validatedInventoryDetails['hardware_id'] = $request->input('hardware_id')[$key];
        //                     //     $validatedInventoryDetails['quantity'] = $request->input('quantity')[$key];
        //                     //     InventoryDetail::create($validatedInventoryDetails);
        //                     // } else {
        //                         // echo "exist";
        //                     // }
        //                 // }
        //             }
        //         } else {
                
        //         }    
        //     } else {
        //         // return redirect('/inventory/create')->with('failed', 'At least 1 item must be selected!');
        //     }
            
                
        //         die;
        //         for($i = 0; $i < count($request->input('hardware_id')); $i++) {
        //             $validatedInventoryDetails['inventory_id'] = $inventory->id;
        //             $validatedInventoryDetails['hardware_id'] = $request->input('hardware_id')[$i];
        //             $validatedInventoryDetails['quantity'] = $request->input('quantity')[$i];
        //             var_dump($validatedInventoryDetails);
        //             // InventoryDetail::where('inventory_id', $inventory->id)->update($validatedInventoryDetails);
        //         }
        //         // return redirect('/inventory')->with('success', 'Inventory data successfully updated');
        // return redirect('/inventory');   
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