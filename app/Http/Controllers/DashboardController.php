<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all products for the dashboard
        $products = Product::with('seller')->latest()->paginate(12);
        
        return view('dashboard', compact('products'));
    }
}