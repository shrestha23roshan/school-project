<?php
namespace Modules\ContentManagement\Repositories\Message;

use App\Repositories\BaseRepositoryEloquent;
use Modules\ContentManagement\Entities\Message;

class MessageRepositoryEloquent extends BaseRepositoryEloquent implements MessageRepository
{
    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
}