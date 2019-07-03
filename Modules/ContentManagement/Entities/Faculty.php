<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';
    
    protected $fillable = [
        'full_name',
        'department',
        'designation',
        'type',
        'attachment',
        'is_active',
       
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
