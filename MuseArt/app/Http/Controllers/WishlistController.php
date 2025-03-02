<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist', compact('wishlistItems'));
    }

    public function getWishlists()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.admin', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        //Checking if product already exists in wishlist

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This product is already in your wishlist');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,

        ]);

        return back()->with('success', 'Product added to wishlist!');
    }

    public function destroy($id)
    {
        $wishlistItem = Wishlist::where('id', $id)->where('user_id', Auth::id())->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from wishlist.');
        }

        return back()->with('error', 'Product not found.');
    }

    // Method for admin to delete any user's wishlist item
    public function adminDestroy($id)
    {
        $wishlistItem = Wishlist::find($id);

        if (!$wishlistItem) {
            return redirect()->back()->with('error', 'Wishlist item not found.');
        }

        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Wishlist item deleted successfully.');
    }
}
