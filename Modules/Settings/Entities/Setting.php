<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_email',
        'site_phone',
        'site_address',
        'site_description',
        'site_logo',
        'site_favicon',
        'site_copyright',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'google_plus_url',
        'youtube_url'
    ];

    protected $hidden = ['created_at', 'updated_at'];

}
