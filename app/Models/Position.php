<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model {
    use HasFactory;

    protected $fillable = [
        'position_name',
        'level',
        'sub_level',
        'department_id',
        'sub_department_id',
        'parent_id',
    ];

    public function parent() {
        return $this->belongsTo(Position::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Position::class, 'parent_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function subDepartment() {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }
}