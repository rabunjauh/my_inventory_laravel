<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;

class Processor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }
}
