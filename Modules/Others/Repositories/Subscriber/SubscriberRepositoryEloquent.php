<?php
namespace Modules\Others\Repositories\Subscriber;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Others\Entities\Subscriber;


class SubscriberRepositoryEloquent extends BaseRepositoryEloquent implements SubscriberRepository
{
    protected $model;

    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }
}