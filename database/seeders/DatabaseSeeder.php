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
use App\Models\itemStock;
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
        // 1
        Inventory::create([
            "do_date" => "2022-11-23",
            "do_no" => "43241234",
            "inventory_date" => "2022-11-23",
            "remark" => "",
            "supplier_id" => 1
        ]);
        // 1
        InventoryDetail::create([
            "inventory_id" => 1,
            "hardware_id" => 1,
            "quantity" => 10,
        ]);
        // 2
        InventoryDetail::create([
            "inventory_id" => 1,
            "hardware_id" => 2,
            "quantity" => 5,
        ]);
        // 1
        Supplier::create([
            "name" => "Wasco Warehouse"
        ]);
        // 1
        Hardware::create([
            "code" => "1",
            "hardware_category_id" => 1,
            "name" => "Dell Optiplex 5080",
            "manufacturer_id" => 3,
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
        // 2
        Hardware::create([
            "code" => "2",
            "hardware_category_id" => 1,
            "name" => "Dell Latitude 5411",
            "manufacturer_id" => 3,
            "serial_number" => "ffeeefds",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "fedss",
            "hardware_type_id" => 2,
            "hardware_model_id" => 2,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "erafdsaf"
        ]);
        // 3
        Hardware::create([
            "code" => "3",
            "hardware_category_id" => 1,
            "name" => "Dell Latitude 5411 2",
            "manufacturer_id" => 3,
            "serial_number" => "llklklk",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "fedss",
            "hardware_type_id" => 2,
            "hardware_model_id" => 2,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "erafdsaf"
        ]);
        // 4
        Hardware::create([
            "code" => "4",
            "hardware_category_id" => 1,
            "name" => "Dell Latitude 3410",
            "manufacturer_id" => 3,
            "serial_number" => "758900fd",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "iielwl",
            "hardware_type_id" => 2,
            "hardware_model_id" => 3,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "hhttttt"
        ]);
        // 4
        Hardware::create([
            "code" => "5",
            "hardware_category_id" => 1,
            "name" => "Dell Optiplex 3000",
            "manufacturer_id" => 3,
            "serial_number" => "od55aofdo",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "kldjaslfjsd",
            "hardware_type_id" => 1,
            "hardware_model_id" => 4,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "jlk;dfakjds"
        ]);
        Hardware::create([
            "code" => "6",
            "hardware_category_id" => 1,
            "name" => "Dell Optiplex 7000",
            "manufacturer_id" => 3,
            "serial_number" => "od55aofdo",
            "status" => 1,
            // "warranty_start" => "",
            // "warranty_end" => "",
            "description" => "",
            "image_name" => "image",
            "image_format" => "jpg",
            "remark" => "",
            "service_code" => "kldjaslfjsd",
            "hardware_type_id" => 1,
            "hardware_model_id" => 5,
            "processor_id" => 1,
            "memory_id" => 1,
            "graphic_card_id" => 1,
            "storage_id" => 1,
            "computer_name" => "jlk;dfakjds"
        ]);
        // 1
        Storage::create([
            "size" => "2.5",
            "capacity" => "500 GB",
            "manufacturer_id" => 1,
            "technology" => "SSD",
            "type" => "SATA"
        ]);
        // 2
        Storage::create([
            "size" => "2.5 Inch",
            "capacity" => "500 GB",
            "manufacturer_id" => 1,
            "technology" => "SSD",
            "type" => "M2 NVMe"
        ]);
        // 1
        Manufacturer::create([
            "name" => "Seagate"
        ]);
        // 2
        Manufacturer::create([
            "name" => "Samsung"
        ]);
        // 3
        Manufacturer::create([
            "name" => "Dell"
        ]);
        // 4
        Manufacturer::create([
            "name" => "Intel"
        ]);
        // 1
        GraphicCard::create([
            "type" => "GDDR5",
            "capacity" => "48 GB",
            "model" => "GTX fdafd",
            "manufacturer_id" => 1,
            "description" => ""
        ]);
        // 1
        HardwareCategory::create([
            "name" => "Workstation"
        ]);
        // 2
        HardwareCategory::create([
            "name" => "Accessories"
        ]);
        // 1
        HardwareModel::create([
            "name" => "Optiplex 5080",
            "manufacturer_id" => 2,            
        ]);
        // 2
        HardwareModel::create([
            "name" => "Latitude 5411",
            "manufacturer_id" => 2,            
        ]);
        // 3
        HardwareModel::create([
            "name" => "Latitude 3410",
            "manufacturer_id" => 2,            
        ]);
        // 4
        HardwareModel::create([
            "name" => "Optiplex 3000",
            "manufacturer_id" => 2,            
        ]);
        // 5
        HardwareModel::create([
            "name" => "Optiplex 7000",
            "manufacturer_id" => 2,            
        ]);
        // 1
        HardwareType::create([
            "name" => "Desktop"
        ]);
        // 2
        HardwareType::create([
            "name" => "Laptop"
        ]);
        // 3
        HardwareType::create([
            "name" => "Monitor"
        ]);
        // 4
        HardwareType::create([
            "name" => "Keyboard"
        ]);
        // 1
        Memory::create([
            "type" => "DDR5",
            "module" => "SODIMM",
            "capacity" => "16 GB",
            "manufacturer_id" => 4,
            "description" => "",
        ]);
        // 1
        Processor::create([
            "model_no" => "17-10850",
            "manufacturer_id" =>  4,
            "core" => 6,
            "frequency" => "2.70 GHz",
            "memory_support" => "DDR4-2933"
        ]);

        itemStock::create([
            "hardware_id"  => 1,
            "stock" => 1
        ]);
    }
}
