<?php

namespace Modules\SchoolManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        
		'full_name',
		'batch',
		'email',
		'phone_no',
		'address',
		'occupation',
        'message',
        'attachment',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
