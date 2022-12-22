<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function graphicCard() {
        return $this->belongsTo(graphicCard::class);
    }
    
    public function hardwareCategory()  {
        return $this->belongsTo(HardwareCategory::class);
    }

    public function hardwareModel() {
        return $this->belongsTo(HardwareModel::class);
    }

    public function hardwareType() {
        return $this->belongsTo(HardwareType::class);
    }

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    public function memory() {
        return $this->belongsTo(Memory::class);
    }
    
    public function processor() {
        return $this->belongsTo(Processor::class);
    }
    
    public function storage() {
        return $this->belongsTo(Storage::class);
    }

    public function inventoryDetail() {
        return $this->hasMany(InventoryDetail::class);
    }

    public function itemStock() {
        return $this->hasMany(itemStock::class);
    }
}
 