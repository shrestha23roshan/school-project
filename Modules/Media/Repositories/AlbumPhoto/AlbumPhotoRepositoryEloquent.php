<?php
namespace Modules\Media\Repositories\AlbumPhoto;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Media\Entities\AlbumPhoto;


class AlbumPhotoRepositoryEloquent extends BaseRepositoryEloquent implements AlbumPhotoRepository
{
    protected $model;

    public function __construct(AlbumPhoto $model)
    {
        $this->model = $model;
    }

     /**
     * Find photos based on album id and return
     * Date: Sunday, Dec 30, 2018
     */
    public function findByAlbumId($id)
    {
        return $this->model->where('album_id', '=', $id)->get();
    }
}