<?php

namespace Modules\NewsAndEvent\Entities;

use Illuminate\Database\Eloquent\Model;

class NewsAndEvent extends Model
{
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'newsandevents';

    protected $fillable = [
        'heading',
        'date',
        'attachment',
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];
     protected $hidden = ['created_at', 'updated_at'];
}
