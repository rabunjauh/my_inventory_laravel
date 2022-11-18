<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Storage;
use App\Models\Manufacturer;

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
    }
}
