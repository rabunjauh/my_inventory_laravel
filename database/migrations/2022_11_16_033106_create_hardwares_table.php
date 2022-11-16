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
        Schema::create('hardwares', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->tinyInteger('category_id');
            $table->string('name');
            $table->tinyInteger('manufacturer_id');
            $table->string('serial_number');
            $table->string('status');
            $table->date('warranty_start');
            $table->date('warranty_end');
            $table->text('description');
            $table->string('image_name');
            $table->string('image_formant');
            $table->text('remark');
            $table->string('service_code');
            $table->tinyInteger('type_id');
            $table->tinyInteger('model_id');
            $table->tinyInteger('processor_id');
            $table->tinyInteger('memory_id');
            $table->tinyInteger('graphic_card_id');
            $table->tinyInteger('storage_id');
            $table->string('computer_name');
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
        Schema::dropIfExists('hardwares');
    }
};
