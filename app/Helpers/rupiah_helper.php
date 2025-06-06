<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($amount, $with_prefix = true)
    {
        $formatted = number_format((float) $amount, 0, ',', '.');
        return $with_prefix ? 'Rp ' . $formatted : $formatted;
    }
}
