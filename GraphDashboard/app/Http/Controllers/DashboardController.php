<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get sales data for the last 12 months
        $salesByMonth = $this->getSalesByMonth();
        
        // Get revenue vs expenses comparison
        $revenueExpenses = $this->getRevenueExpensesComparison();
        
        // Get category breakdown
        $categoryBreakdown = $this->getCategoryBreakdown();
        
        // Get units sold trend
        $unitsTrend = $this->getUnitsSoldTrend();
        
        // Get key metrics
        $totalRevenue = Sale::sum('revenue');
        $totalExpenses = Sale::sum('expenses');
        $totalUnitsSold = Sale::sum('units_sold');
        $totalProfit = $totalRevenue - $totalExpenses;
        
        return view('dashboard', compact(
            'salesByMonth',
            'revenueExpenses',
            'categoryBreakdown',
            'unitsTrend',
            'totalRevenue',
            'totalExpenses',
            'totalUnitsSold',
            'totalProfit'
        ));
    }
    
    private function getSalesByMonth()
    {
        $data = Sale::selectRaw('MONTH(sale_date) as month, YEAR(sale_date) as year, SUM(revenue) as total_revenue')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        $labels = [];
        $revenues = [];
        
        foreach ($data as $item) {
            $date = Carbon::create($item->year, $item->month, 1);
            $labels[] = $date->format('M Y');
            $revenues[] = (float)$item->total_revenue;
        }
        
        return [
            'labels' => $labels,
            'revenues' => $revenues
        ];
    }
    
    private function getRevenueExpensesComparison()
    {
        $data = Sale::selectRaw('MONTH(sale_date) as month, YEAR(sale_date) as year, SUM(revenue) as total_revenue, SUM(expenses) as total_expenses')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        $labels = [];
        $revenues = [];
        $expenses = [];
        
        foreach ($data as $item) {
            $date = Carbon::create($item->year, $item->month, 1);
            $labels[] = $date->format('M');
            $revenues[] = (float)$item->total_revenue;
            $expenses[] = (float)$item->total_expenses;
        }
        
        return [
            'labels' => $labels,
            'revenues' => $revenues,
            'expenses' => $expenses
        ];
    }
    
    private function getCategoryBreakdown()
    {
        $data = Sale::selectRaw('category, SUM(revenue) as total_revenue')
            ->where('category', '!=', null)
            ->groupBy('category')
            ->get();
        
        $labels = [];
        $revenues = [];
        
        foreach ($data as $item) {
            $labels[] = $item->category;
            $revenues[] = (float)$item->total_revenue;
        }
        
        return [
            'labels' => $labels,
            'revenues' => $revenues
        ];
    }
    
    private function getUnitsSoldTrend()
    {
        $data = Sale::selectRaw('MONTH(sale_date) as month, YEAR(sale_date) as year, SUM(units_sold) as total_units')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        $labels = [];
        $units = [];
        
        foreach ($data as $item) {
            $date = Carbon::create($item->year, $item->month, 1);
            $labels[] = $date->format('M Y');
            $units[] = (int)$item->total_units;
        }
        
        return [
            'labels' => $labels,
            'units' => $units
        ];
    }
}

