<?php
namespace Modules\Seo\Repositories\Seo;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Seo\Entities\Seo;

class SeoRepositoryEloquent extends BaseRepositoryEloquent implements SeoRepository
{
    protected $model;

    public function __construct(Seo $model)
    {
        $this->model = $model;
    }
}