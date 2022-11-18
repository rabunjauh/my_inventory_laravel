<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\GraphicCard;
use App\Models\Memory;
use App\Models\Storage;

class Manufacturer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function graphicCard() {
        $this->hasMany(GraphicCard::class);
    }

    public function memory() {
        $this->hasMany(Memory::class);
    }

    public function storage() {
        $this->hasMany(Storage::class);
    }
}
