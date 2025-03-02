<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\User;
use App\Models\Product;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated and determine the user type
        if (Auth::check()) {
            // Get the authenticated user's type
            $user = Auth::user();

            // Fetch products and artists
            $products = Product::paginate(4);  // Fetch all products
            $artists = Artist::all();    // Fetch all artists
            $events = Event::all(); //Fetch all events
            $subscribedUsers = User::where('is_subscribed', 1)->get();


            // If the user is an admin, return the admin dashboard view
            if ($user->userType == 'admin') {

                return view('admin.dashboard', compact('products', 'artists', 'events'));
            } else if ($user->userType == 'user') {

                return view('home', compact('products', 'artists', 'events'));
            } else {
                return view('artists.artist', compact('products', 'artists', 'events', 'subscribedUsers'));
            }
        }
        return redirect()->route('login');
    }

    public function post()
    {
        return view("post");
    }
}
