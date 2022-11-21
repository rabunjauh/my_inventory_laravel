<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hardware() {
        return $this->hasMany(Hardware::class);
    }
}
