<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hardware() {
        return $this->belongsTo(Hardware::class);
    }

    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }
}
