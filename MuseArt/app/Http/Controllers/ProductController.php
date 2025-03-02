<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    // Display all products
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    // Show a single product by slug
    public function show($id)
    {
        // Find the product by slug
        $product = Product::findOrFail($id);

        return view('products.show', compact('product')); // Return the details view
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        //Find the product by slug

        $product = Product::findOrFail($id);

        if (!$product) {
            return redirect()->route('products')->with('error', 'Product not found.');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'long_description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //Updating product details

        $product->name = $request->name;
        $product->description = $request->description;
        $product->long_description = $request->long_description;
        $product->price = floatval($request->price);

        //If there's an image upload it and save the path.

        if ($request->hasFile('image')) {
            //Delete the old image if it exists

            if ($product->image && Storage::disk('public')->exists($product->image)) {

                Storage::disk('public')->delete($product->image);
            }

            //For storing the new image and updating the product
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    // Storing a new product
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'description' => 'required',
            'price' => 'required|numeric',
            'long_description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name); // Generate slug


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products'); // Store in storage/app/public/products
            $data['image'] = str_replace('public/', '', $path);
        }

        Product::create($data);  //Creating a new product

        return redirect()->route('products')->with('success', 'Product was added successfully.');
    }

    //for verifying product payment


    public function verifyKhaltiPayment(Request $request)
    {
        $payload = $request->all(); // Get the token and amount from the request

        // Verify the payment with Khalti API
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY'), // Your secret key
        ])->post('https://dev.khalti.com/api/v2/epayment/lookup/', [
            'token' => $payload['token'], // Pass the token received from Khalti
        ]);

        $paymentStatus = $response->json();

        // Check the response status from Khalti API
        if (isset($paymentStatus['status']) && $paymentStatus['status'] === 'Completed') {
            // Payment was successful
            return response()->json(['message' => 'Payment Successful!']);
        } else {
            // Payment failed
            return response()->json(['message' => 'Payment Verification Failed']);
        }
    }


    public function initiatePayment(Request $request)
    {
        $amount = 1300;  // Amount in paisa (e.g., Rs. 13.00)
        $purchase_order_id = 'order123';
        $purchase_order_name = 'Sample Product';

        // Make a POST request to Khalti API to initiate payment
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY')
        ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', [
            'return_url' => route('payment.callback'),  // Your callback route
            'website_url' => url('/'),
            'amount' => $amount,
            'purchase_order_id' => $purchase_order_id,
            'purchase_order_name' => $purchase_order_name,
            'customer_info' => [
                'name' => 'Customer Name',
                'email' => 'customer@example.com',
                'phone' => '9800000001'
            ]
        ]);

        $paymentData = $response->json();

        if ($response->successful()) {
            // Redirect user to Khalti payment page
            return redirect($paymentData['payment_url']);
        }

        return redirect()->back()->with('error', 'Payment initiation failed.');
    }

    public function paymentCallback(Request $request)
    {
        // Retrieve the data from Khalti's response
        $pidx = $request->input('pidx');
        $status = $request->input('status');
        $transaction_id = $request->input('transaction_id');
        $purchase_order_id = $request->input('purchase_order_id');

        if ($status == 'Completed') {
            // Make an API call to validate the payment status
            $response = Http::withHeaders([
                'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY')
            ])->post('https://dev.khalti.com/api/v2/epayment/lookup/', [
                'pidx' => $pidx
            ]);

            $paymentStatus = $response->json();
            if ($paymentStatus['status'] == 'Completed') {
                // Payment successful, do your processing here
                return view('payment.success', ['transaction_id' => $transaction_id]);
            }
        }

        // If payment failed or was canceled
        return view('payment.failed');
    }

    // Deleting a Product
    public function destroy($id)
    {
        // Find the product by slug
        $product = Product::where('slug', $id)->firstOrFail();

        // Delete the associated image from storage, if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products')->with('success', 'Product was deleted successfully.');
    }
}
