<?php

use App\Models\Common\SettingModel;

function getConfig($key)
{
    $settingModel  = new SettingModel();
    $config = $settingModel->getConfig($key);
    return $config['value'];
}
