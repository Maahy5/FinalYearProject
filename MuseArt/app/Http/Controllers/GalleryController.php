<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class GalleryController extends Controller
{
    public function index()
    {
        $products = Product::all();  //Changes the product to products
        return view('gallery.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('gallery.show', compact('product'));
    }
}
