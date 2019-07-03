<?php
namespace Modules\SchoolManagement\Repositories\Alumni;

use App\Repositories\BaseRepositoryEloquent;
use Modules\SchoolManagement\Entities\Alumni;

class AlumniRepositoryEloquent extends BaseRepositoryEloquent implements AlumniRepository
{
    protected $model;

    public function __construct(Alumni $model)
    {
        $this->model = $model;
    }
}
