<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats data
        $stats = [
            'totalUsers' => User::count(),
            'averageTime' => 154.25, // Calculate dari sleep records
        ];
        
        // Chart data (daily, weekly, monthly)
        $dailyData = $this->getDailyData();
        $weeklyData = $this->getWeeklyData();
        $monthlyData = $this->getMonthlyData();
        $sleepTimeData = $this->getSleepTimeData();
        
        return view('dashboard.index', compact(
            'stats',
            'dailyData',
            'weeklyData',
            'monthlyData',
            'sleepTimeData'
        ));
    }
    
    private function getDailyData()
    {
        // Get data untuk 7 hari terakhir
        // Return format: ['labels' => [...], 'female' => [...], 'male' => [...]]
        return [
            'labels' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
            'female' => [180, 220, 190, 240, 200, 160, 120],
            'male' => [150, 200, 170, 210, 180, 140, 100],
        ];
    }
    
    private function getWeeklyData()
    {
        // Get data untuk 4 minggu terakhir
        return [
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            'female' => [1200, 1400, 1100, 1500],
            'male' => [1000, 1200, 900, 1300],
        ];
    }
    
    private function getMonthlyData()
    {
        // Get data untuk 10 bulan terakhir
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            'female' => [3200, 3500, 3100, 3800, 3400, 3600, 3300, 3700, 3500, 3900],
            'male' => [2800, 3000, 2700, 3200, 2900, 3100, 2800, 3200, 3000, 3400],
        ];
    }
    
    private function getSleepTimeData()
    {
        // Get average sleep time data
        return [
            'labels' => ['Jan 01', 'Jan 02', 'Jan 03', 'Jan 04', 'Jan 05', 'Jan 06'],
            'female' => [3, 5, 4, 6, 5, 7],
            'male' => [2, 4, 3, 5, 4, 6],
        ];
    }
}