<?php
use App\Models\Setting;
function getConfigValueSetting($configKey)
{
    $settingConfig = Setting::where('config_key', $configKey)->first();
    if (!empty($settingConfig)) {
        return $settingConfig->config_value;
    }
    return null;
}


