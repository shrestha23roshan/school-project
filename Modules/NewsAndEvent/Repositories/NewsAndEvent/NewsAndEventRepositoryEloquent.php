<?php
namespace Modules\NewsAndEvent\Repositories\NewsAndEvent;

use App\Repositories\BaseRepositoryEloquent;
use Modules\NewsAndEvent\Entities\NewsAndEvent;

class NewsAndEventRepositoryEloquent extends BaseRepositoryEloquent implements NewsAndEventRepository
{
    protected $model;

    public function __construct(NewsAndEvent $model)
    {
        $this->model = $model;
    }
}