<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model {
    use HasFactory;

    protected $fillable = [
        'sub_department_longname',
        'sub_department_shortname',
        'sub_department_code',
    ];
}
