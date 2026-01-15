<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JurnalController extends Controller
{
    /**
     * Jurnal Daily
     */
    public function daily()
    {
        $user = auth()->user();
        
        // Data dummy untuk development
        $stats = [
            'users' => 1000,
            'avgDuration' => '7 jam 2 menit',
            'avgTime' => '21:30 - 06:10',
        ];
        
        return view('jurnal.daily', compact('user', 'stats'));
    }
    
    /**
     * Jurnal Weekly
     */
    public function weekly()
    {
        $user = auth()->user();
        
        // Data dummy untuk development
        $stats = [
            'users' => 7500,
            'avgDuration' => '7 jam 15 menit',
            'avgTime' => '22:00 - 06:30',
        ];
        
        return view('jurnal.weekly', compact('user', 'stats'));
    }
    
    /**
     * Jurnal Monthly
     */
    public function monthly()
    {
        $user = auth()->user();
        
        // Data dummy untuk development
        $stats = [
            'users' => 28000,
            'avgDuration' => '7 jam 30 menit',
            'avgTime' => '22:15 - 06:45',
        ];
        
        return view('jurnal.monthly', compact('user', 'stats'));
    }
}