<?php
namespace Modules\ContentManagement\Repositories\Banner;

use App\Repositories\BaseRepositoryEloquent;
use Modules\ContentManagement\Entities\Banner;

class BannerRepositoryEloquent extends BaseRepositoryEloquent implements BannerRepository
{
    protected $model;

    public function __construct(Banner $model)
    {
        $this->model = $model;
    }
}