<?php
namespace Modules\Others\Repositories\Feedback;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Others\Entities\Feedback;


class FeedbackRepositoryEloquent extends BaseRepositoryEloquent implements FeedbackRepository
{
    protected $model;

    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }
}