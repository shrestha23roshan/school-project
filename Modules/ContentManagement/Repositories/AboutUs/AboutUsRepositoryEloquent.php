<?php
namespace Modules\ContentManagement\Repositories\AboutUs;

use App\Repositories\BaseRepositoryEloquent;
use Modules\ContentManagement\Entities\AboutUs;


class AboutUsRepositoryEloquent extends BaseRepositoryEloquent implements AboutUsRepository
{
    protected $model;

    public function __construct(AboutUs $model)
    {
        $this->model = $model;
    }
}