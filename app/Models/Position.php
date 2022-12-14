<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function employee() {
        return $this->hasMany(Employee::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function itemRequest() {
        return $this->hasManyThrough(ItemRequest::class, Employee::class);
    }
}
