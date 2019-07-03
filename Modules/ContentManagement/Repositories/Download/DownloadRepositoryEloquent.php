<?php
namespace Modules\ContentManagement\Repositories\Download;

use App\Repositories\BaseRepositoryEloquent;
use Modules\ContentManagement\Entities\Download;


class DownloadRepositoryEloquent extends BaseRepositoryEloquent implements DownloadRepository
{
    protected $model;

    public function __construct(Download $model)
    {
        $this->model = $model;
    }
}