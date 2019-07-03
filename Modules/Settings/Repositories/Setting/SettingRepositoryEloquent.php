<?php
namespace Modules\Settings\Repositories\Setting;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Settings\Entities\Setting;

class SettingRepositoryEloquent extends BaseRepositoryEloquent implements SettingRepository
{
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function getSetting() 
    {
        return $this->model->where('id', '=', '1')->first();
    }
}