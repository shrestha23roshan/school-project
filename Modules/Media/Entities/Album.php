<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Album extends Model
{
    use Sluggable;
    
    protected $fillable = [
        'name',
        'slug',
        'attachment',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Return the sluggable configuration array for this model.
     * 
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function photos()
    {
        return $this->hasMany(AlbumPhoto::class, 'album_id');
    }
}



