<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hardware() {
        return $this->belongsTo(Hardware::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
