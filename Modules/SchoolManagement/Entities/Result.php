<?php

namespace Modules\SchoolManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'full_name',
        'registration_no',
        'class',
        'remark',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $hidden =['created_at', 'updated_at'];
}
