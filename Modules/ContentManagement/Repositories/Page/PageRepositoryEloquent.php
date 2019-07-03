<?php
namespace Modules\ContentManagement\Repositories\Page;

use App\Repositories\BaseRepositoryEloquent;
use Modules\ContentManagement\Entities\Page;


class PageRepositoryEloquent extends BaseRepositoryEloquent implements PageRepository
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}