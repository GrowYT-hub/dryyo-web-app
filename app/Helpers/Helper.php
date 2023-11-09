<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Fluent;

class Helper
{
    public static function hydrate($data)
    {
        return new Fluent($data);
    }
}