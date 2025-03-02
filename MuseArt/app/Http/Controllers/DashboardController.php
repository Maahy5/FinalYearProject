<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Artist;
use App\Models\User;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Ensure only admins can access
    }

    public function index()
    {
        // Fetch data you want to display on the dashboard
        $usersCount = User::count();
        $productsCount = Product::count();
        $artistsCount = Artist::count();

        // Return the dashboard view and pass data to it
        return view('admin.dashboard', compact('usersCount', 'productsCount', 'artistsCount'));
    }
}
