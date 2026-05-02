<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = now();
        $startOfToday = $now->copy()->startOfDay();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfPreviousMonth = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $endOfPreviousMonth = $startOfMonth->copy()->subSecond();
        $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY);

        $totalRevenue = (float) Order::sum('total');
        $currentMonthRevenue = (float) Order::where('created_at', '>=', $startOfMonth)->sum('total');
        $previousMonthRevenue = (float) Order::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->sum('total');

        $revenueChange = $previousMonthRevenue > 0
            ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100
            : ($currentMonthRevenue > 0 ? 100.0 : 0.0);

        $ordersToday = Order::where('created_at', '>=', $startOfToday)->count();
        $processingOrders = Order::whereIn('status', ['pending', 'processing'])->count();

        $productCount = Product::count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        $customerCount = User::where('role', 'customer')->count();
        $newCustomersThisWeek = User::where('role', 'customer')
            ->where('created_at', '>=', $startOfWeek)
            ->count();

        $weeklyRevenue = collect(range(0, 6))
            ->map(function (int $offset) use ($startOfWeek) {
                $date = $startOfWeek->copy()->addDays($offset);
                $dailyRevenue = (float) Order::whereDate('created_at', $date)->sum('total');

                return [
                    'label' => $date->format('D'),
                    'full_label' => $date->format('M d'),
                    'revenue' => $dailyRevenue,
                ];
            });

        $maxWeeklyRevenue = (float) max($weeklyRevenue->pluck('revenue')->max(), 1);

        $weeklyRevenue = $weeklyRevenue->map(function (array $day) use ($maxWeeklyRevenue) {
            $height = $day['revenue'] > 0 ? max(($day['revenue'] / $maxWeeklyRevenue) * 100, 12) : 10;
            $day['height'] = round($height, 2);

            return $day;
        });

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'revenueChange' => $revenueChange,
            'ordersToday' => $ordersToday,
            'processingOrders' => $processingOrders,
            'productCount' => $productCount,
            'lowStockCount' => $lowStockCount,
            'customerCount' => $customerCount,
            'newCustomersThisWeek' => $newCustomersThisWeek,
            'weeklyRevenue' => $weeklyRevenue,
            'recentOrders' => $recentOrders,
        ]);
    }
}
