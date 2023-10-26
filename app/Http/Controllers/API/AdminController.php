<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $AdminService;

    function __construct()
    {
        $this->AdminService = new AdminService();
    }
    public function reports()
    {
        $reports = $this->AdminService->reports();
        return response()->json([
            "status" => true,
            "data" => $reports
        ]);
    }
}
