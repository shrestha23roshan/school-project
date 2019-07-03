<?php
namespace Modules\Media\Repositories\AlbumPhoto;

interface AlbumPhotoRepository
{
    public function all();
    public function findByAlbumId($id);
}