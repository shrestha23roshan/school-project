<?php
namespace Modules\ContentManagement\Repositories\Notice;

use Modules\ContentManagement\Entities\Notice;
use App\Repositories\BaseRepositoryEloquent;

class NoticeRepositoryEloquent extends BaseRepositoryEloquent implements NoticeRepository
{
    protected $model;

    public function __construct(Notice $model)
    {
        $this->model = $model;
    }

    /**
     * Get active notices
     * Created date:thrusday ,12/27/2018
     * Updated date:null
     * Used: frontend
     * 
     * @return Notices
     */
    public function getActiveNotices()
    {
        return $this->model->where('is_active', '1')->get();
    }
}

