<?php
namespace Modules\ContentManagement\Repositories\Notice;

interface NoticeRepository
{
    public function all();
    public function getActiveNotices();
}