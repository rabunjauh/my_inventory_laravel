<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->tinyInteger('hardware_category_id');
            $table->string('name');
            $table->tinyInteger('manufacturer_id');
            $table->string('serial_number');
            $table->string('status');
            $table->date('warranty_start')->nullable();
            $table->date('warranty_end')->nullable();
            $table->text('description')->nullable();
            $table->string('image_name')->default('image');
            $table->string('image_format')->default('jpg');
            $table->text('remark')->nullable();
            $table->string('service_code')->nullable();
            $table->tinyInteger('hardware_type_id');
            $table->tinyInteger('hardware_model_id');
            $table->tinyInteger('processor_id');
            $table->tinyInteger('memory_id');
            $table->tinyInteger('graphic_card_id');
            $table->tinyInteger('storage_id');
            $table->string('computer_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hardware');
    }
};
