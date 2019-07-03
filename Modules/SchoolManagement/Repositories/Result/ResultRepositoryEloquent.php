<?php
namespace Modules\SchoolManagement\Repositories\Result;

use App\Repositories\BaseRepositoryEloquent;
use Modules\SchoolManagement\Entities\Result;


class ResultRepositoryEloquent extends BaseRepositoryEloquent implements ResultRepository
{
    protected $model;

    public function __construct(Result $model)
    {
        $this->model = $model;
    }
}