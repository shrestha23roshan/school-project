<?php
namespace Modules\Media\Repositories\Album;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Media\Entities\Album;

class AlbumRepositoryEloquent extends BaseRepositoryEloquent implements AlbumRepository
{
    protected $model;

    public function __construct(Album $model)
    {
        $this->model = $model;
    }

    //Front end
    /**
     * Find album based on slug and return
     * Date: Sunday, Dec 30, 2018
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    /**
     * Find active album and paginate
     * Date: Sunday, Dec 30, 2018
     */
    public function albumAndPaginate($paginate)
    {
        return $this->model->where('is_active', '=', '1')->orderBy('created_at', 'desc')->paginate($paginate);
    }

    /**
     * Find active album used in frontend.index(only)
     * Date: Sunday, Dec 30, 2018
     */
    public function isActiveAlbums()
    {
        return $this->model->where('is_active', '=', '1')->orderBy('created_at', 'desc')->get();
    }
}