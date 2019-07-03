<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'subject',
        'date',
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d F Y');
    }

    public function getFormattedDate($date)
    {
        Date::setLocale('ne');
        return Date::parse($date)->format('l j F Y');
    }
}
