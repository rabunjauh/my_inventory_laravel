<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function hod() {
        return $this->belongsTo(Employee::class);
    }

    public function department_member() {
        return $this->hasMany(Employee::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }
}
