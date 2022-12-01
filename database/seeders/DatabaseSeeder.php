<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\InventoryDetail;
use App\Models\GraphicCard;
use App\Models\Hardware;
use App\Models\HardwareCategory;
use App\Models\HardwareModel;
use App\Models\HardwareType;
use App\Models\Manufacturer;
use App\Models\Memory;
use App\Models\Processor;
use App\Models\Storage;
use App\Models\Supplier;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Inventory::create([
            "do_date" => "2022-11-23",
            "do_no" => "43241234",
            "inventory_date" => "2022-11-23",
            "remark" => "",
            "supplier_id" => 1
        ]);

        InventoryDetail::create([
            "inventory_id" => 1,
            "hardware_id" => 1,
            "quantity" => 10,
        ]);
        
        InventoryDetail::create([
            "inventory_id" => 1,
            "hardware_id" => 1,
            "quantity" => 5,
        ]);

        Supplier::create([
            "name" => "Wasco Warehouse"
        ]);

        Hardware::create([
            "code" => "1",
            "hardware_category_id" => 1,
            "name" => "Dell Optiplex 5080",
            "manufacturer_id" => 1,
            "serial_number" => "dafasdf",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "adsfasdfas",
            "hardware_type_id" => 1,
            "hardware_model_id" => 1,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "dfadsaf"
        ]);
        
        Hardware::create([
            "code" => "2",
            "hardware_category_id" => 1,
            "name" => "Dell Optiplex 5080",
            "manufacturer_id" => 1,
            "serial_number" => "ffeeefds",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "fedss",
            "hardware_type_id" => 1,
            "hardware_model_id" => 1,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "erafdsaf"
        ]);

        Storage::create([
            "size" => "2.5",
            "capacity" => "500 GB",
            "manufacturer_id" => 1,
            "technology" => "SSD",
            "type" => "SATA"
        ]);

        Manufacturer::create([
            "name" => "Seagate"
        ]);
        
        Manufacturer::create([
            "name" => "Samsung"
        ]);
        
        Manufacturer::create([
            "name" => "Dell"
        ]);
        
        Manufacturer::create([
            "name" => "Intel"
        ]);

        GraphicCard::create([
            "type" => "GDDR5",
            "capacity" => "48 GB",
            "model" => "GTX fdafd",
            "manufacturer_id" => 1,
            "description" => ""
        ]);

        HardwareCategory::create([
            "name" => "Workstation"
        ]);

        HardwareModel::create([
            "name" => "Optiplex 5080",
            "manufacturer_id" => 2,            
        ]);

        HardwareType::create([
            "name" => "Desktop"
        ]);

        Memory::create([
            "type" => "DDR5",
            "module" => "SODIMM",
            "capacity" => "16 GB",
            "manufacturer_id" => 4,
            "description" => "",
        ]);

        Processor::create([
            "model_no" => "17-10850",
            "manufacturer_id" =>  4,
            "core" => 6,
            "frequency" => "2.70 GHz",
            "memory_support" => "DDR4-2933"
        ]);

        Storage::create([
            "size" => "2.5 Inch",
            "capacity" => "500 GB",
            "manufacturer_id" => 1,
            "technology" => "SSD",
            "type" => "M2 NVMe"
        ]);
    }
}
