<?php
namespace Modules\Settings\Repositories\Setting;

interface SettingRepository
{
    public function all();
    public function getSetting();
}