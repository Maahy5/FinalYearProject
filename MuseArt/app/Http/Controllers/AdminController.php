<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $artists = Artist::all();
        $events = Event::all();

        //Returning the admin 

        return view('admin.dashboard', compact('products', 'artists', 'events'));
    }
}
