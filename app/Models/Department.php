<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function employee() {
        return $this->hasMany(Employee::class);
    }

    public function itemRequest() {
        return $this->hasManyThrough(ItemRequest::class, Employee::class);
    }
}
