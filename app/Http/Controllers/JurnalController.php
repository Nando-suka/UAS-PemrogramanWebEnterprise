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
        return view('jurnal.daily', compact('user'));
    }
    
    /**
     * Jurnal Weekly
     */
    public function weekly()
    {
        $user = auth()->user();
        return view('jurnal.weekly', compact('user'));
    }
    
    /**
     * Jurnal Monthly
     */
    public function monthly()
    {
        $user = auth()->user();
        return view('jurnal.monthly', compact('user'));
    }
}