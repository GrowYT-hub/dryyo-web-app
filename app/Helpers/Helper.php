<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Fluent;

class Helper
{
    public static function hydrate($data)
    {
        return new Fluent($data);
    }

    public static function success(string $message = null, array $data = [])
    {
        return response()->json([
            "status" => 1,
            "message" => $message,
            "data" => $data
        ]);
    }

    public static function fail(string $message = null, array $data = [], int $statusCode = 400)
    {
        return response()->json([
            "status" => 0,
            "message" => $message,
            "data" => $data
        ], $statusCode);
    }
}