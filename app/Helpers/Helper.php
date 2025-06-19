<?php

use Illuminate\Support\Str;

if (!function_exists('generate_user_code')) {
    function generate_user_code(string $name, string $surname, int $id): string
    {
        $namePart = strtoupper(Str::limit(Str::slug($name, ''), 2, ''));
        $surnamePart = strtoupper(Str::limit(Str::slug($surname, ''), 3, ''));

        return $namePart . $surnamePart . $id;
    }
}
