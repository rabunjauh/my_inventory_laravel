<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\GraphicCard;
use App\Models\HardwareModel;
use App\Models\Memory;
use App\Models\Storage;

class Manufacturer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function graphicCard() {
        return $this->hasMany(GraphicCard::class);
    }

    public function memory() {
        return $this->hasMany(Memory::class);
    }

    public function storage() {
        return $this->hasMany(Storage::class);
    }
    
    public function hardwareModel() {
        return $this->hasMany(HardwareModel::class);
    }

    public function hardware() {
        return $this->hasMany(Hardware::class);
    }
}
