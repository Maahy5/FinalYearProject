<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Artist;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch products and artists from the database
        $products = Product::paginate(5);
        $artists = Artist::all();

        // Pass data to the view
        return view('welcome', compact('products', 'artists'));
    }
}
