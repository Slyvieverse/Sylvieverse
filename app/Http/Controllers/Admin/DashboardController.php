<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Order;
use App\Models\User;
class DashboardController extends Controller
{
    

    public function index()
    {
        // Key Metrics
        $totalUsers = User::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $totalOrders = Order::count();
        $activeAuctions = Auction::where('status', 'active')->count();

        // Recent Activity
        $recentOrders = Order::with(['user'])->orderBy('created_at', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Chart Data
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->take(6)
            ->pluck('revenue', 'month')
            ->toArray();

        return view('admin.dashboard',
         compact(
            'totalUsers',
            'totalRevenue',
            'totalOrders',
            'activeAuctions',
            'recentOrders',
            'recentUsers',
            'ordersByStatus',
            'monthlyRevenue'
        )
    );
    }
}

