<?php

// Helper function to get configuration from database
if (!function_exists('getAppSetting')) {
    function getAppSetting($key)
    {
        $db = \Config\Database::connect();
        $query = $db->table('app_settings')->where('key', $key)->get();
        $result = $query->getRow();
        return $result ? $result->value : null; // Return the value if it exists
    }
}
