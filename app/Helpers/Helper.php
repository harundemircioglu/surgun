<?php

use Modules\Auth\App\Models\User;

if (!function_exists('generateTwoFactorCode')) {
    function generateTwoFactorCode()
    {
        return random_int(100000, 999999);
    }
}
