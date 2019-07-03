<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
     /**
     * Database table used by the model.
     * 
     * @var string
     */
    protected $table = 'about_us';
    
    protected $fillable = [
        'heading',
        'description',
        'attachment',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
