<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class AlbumPhoto extends Model
{
     /**
     * Database table used by the model.
     * 
     * @var string
     */
    protected $table = 'album_photos';

    protected $fillable = [
        'album_id',
        'attachment',
        'original_name',
        'created_by'.
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
