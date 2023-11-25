<?php

namespace App\Services;

use App\Models\Services;

class AdminService
{
    protected $serviceModel;
    public function __construct()
    {
        $this->serviceModel = new Services();
    }

    public function reports()
    {
        $totalOrders = $this->serviceModel->selectRaw('MONTH(created_at) as month, DATE_FORMAT(created_at, "%b") as month_name, COUNT(*) as total')
            ->where('status', 'Completed')
            ->groupBy('month', 'month_name')
            ->get();
        $totalSalesOrders = $this->serviceModel->selectRaw('MONTH(created_at) as month, DATE_FORMAT(created_at, "%b") as month_name, COUNT(*) as total')
            ->groupBy('month', 'month_name')
            ->orderBy('month', 'ASC')
            ->get();
        $labels = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $orders = [];
        $totalSales = [];

        foreach ($labels as $label) {
            $exists = $totalOrders->where('month_name', $label)->pluck('total')->toArray();
            if ($exists) {
                $orders[$label] = count($exists) > 0 ? $exists[0] : 0;
            } else {
                $orders[$label] = 0;
            }
            $salesExists = $totalSalesOrders->where('month_name', $label)->pluck('total')->toArray();

            if ($salesExists) {
                $totalSales[$label] = count($salesExists) > 0 ? $salesExists[0] : 0;
            } else {
                $totalSales[$label] = 0;
            }
        }

        return [
            "orders" => $orders,
            "totalSales" => $totalSales,
        ];
    }

    public function invoices()
    {
        $orders = $this->serviceModel->with(['user', 'assign'])->where('status', 'Completed')->get();

        return [
            'orders' => $orders
        ];
    }

    public function orders()
    {
        $orders = $this->serviceModel->with(['user', 'assign'])->get();

        return [
            'orders' => $orders
        ];
    }
}