<?php

use App\Models\setting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $cache = [];

        if (isset($cache[$key])) {
            return $cache[$key];
        }

        $value = setting::where('key', $key)->value('value');

        return $cache[$key] = $value ?? $default;
    }
}