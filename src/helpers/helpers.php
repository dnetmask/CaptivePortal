<?php

if (!function_exists('cautiveportal_asset')) {
    function cautiveportal_asset($path, $secure = null)
    {
        return route('cautiveportal.cautiveportal_assets').'?path='.urlencode($path);
    }
}

if (!function_exists('cautiveportal_routes')) {
    function cautiveportal_routes()
    {
        require __DIR__ . '/../routes/cautiveportal.php';
    }
}