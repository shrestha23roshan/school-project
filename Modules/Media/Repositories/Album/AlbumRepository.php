<?php

namespace Modules\Media\Repositories\Album;

interface AlbumRepository
{
    public function all();
    public function findBySlug($slug);
    public function albumAndPaginate($paginate);
    public function isActiveAlbums();
}