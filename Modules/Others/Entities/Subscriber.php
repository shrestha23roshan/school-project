<?php

namespace Modules\Others\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscriber extends Model
{
    protected $fillable = [
        'email'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d F Y');
    }
}
