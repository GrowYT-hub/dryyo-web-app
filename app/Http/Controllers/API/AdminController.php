<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AdminService;

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
            "status" => 1,
            "data" => $reports
        ]);
    }

    public function invoices()
    {
        $invoices = $this->AdminService->invoices();
        return response()->json([
            "status" => 1,
            "data" => $invoices
        ]);
    }

    public function orders()
    {
        $orders = $this->AdminService->orders();
        return response()->json([
            "status" => 1,
            "data" => $orders
        ]);
    }
}
