<?php
namespace Modules\ContentManagement\Repositories\Faculty;

use App\Repositories\BaseRepositoryEloquent;
use Modules\ContentManagement\Entities\Faculty;


class FacultyRepositoryEloquent extends BaseRepositoryEloquent implements FacultyRepository
{
    protected $model;

    public function __construct(Faculty $model)
    {
        $this->model = $model;
    }
}