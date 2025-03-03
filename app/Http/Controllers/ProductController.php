<?php
namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Payment; // Import the Payment model

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }
    public function paymentHistory()
    {
        // Eager load the 'product' and 'user' relationships
        $payments = Payment::with('product', 'user')->get(); 
        
        // Pass the payments data to the view
        return view('payments.history', compact('payments'));
    }
    

    // Show a specific product by ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Show edit form for a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

   // Store a newly created product
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'year_of_purchase' => 'nullable|integer|between:1900,' . date('Y'),
        'category' => 'required|string|in:hats,tshirts,electronics,cosmetics', 
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    $imagePath = $request->file('image') ? $request->file('image')->store('product_images', 'public') : null;

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'year_of_purchase' => $request->year_of_purchase,
        'category' => $request->category,
        'image' => $imagePath, // Save image path
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}
// Update a product
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'year_of_purchase' => 'nullable|integer|between:1900,' . date('Y'),
        'category' => 'required|string|in:hats,tshirts,electronics,cosmetics',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    $product = Product::findOrFail($id);

    // Handle image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            unlink(storage_path('app/public/' . $product->image));
        }

        // Store the new image
        $imagePath = $request->file('image')->store('product_images', 'public');
    } else {
        // Keep the existing image if no new image is uploaded
        $imagePath = $product->image;
    }

    // Update the product with the new data
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'year_of_purchase' => $request->year_of_purchase,
        'category' => $request->category,
        'image' => $imagePath, // Update image path
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function confirmPurchase($id)
    {
        // Logic to process the purchase (e.g., deduct stock, record transaction, etc.)
        $product = Product::findOrFail($id);
    
        // Example: Reduce the stock or mark the product as purchased
        // $product->stock -= 1;
        // $product->save();
    
        return redirect()->route('products.index')->with('success', 'Purchase successful!');
    }
    
    public function paymentForm($id)
    {
        // Fetch the product details by ID
        $product = Product::findOrFail($id);

        // Return the payment form view with the product data
        return view('products.payment', compact('product'));
    }

   // app/Http/Controllers/ProductController.php

   public function processPayment(Request $request, $id)
   {
       // Fetch the product details by ID
       $product = Product::findOrFail($id);
       
       // Check if the product is available before processing payment
       if (!$product->is_available) {
           return redirect()->route('products.index')->with('error', 'This product is no longer available.');
       }
       
       // Here, you can process the payment logic (e.g., integrating with a payment gateway)
       // For now, we will just simulate the payment and record it in the database.
       
       // Ensure the user is authenticated
       $user = auth()->user();
       
       Payment::create([
           'product_id' => $product->id,
           'amount' => $product->price, // Assuming the amount is equal to the product price
           'payment_method' => 'Credit Card', // Example, you can dynamically get this from the form
           'user_id' => $user->id, // Attach the authenticated user's ID
       ]);
       
       // Mark the product as unavailable after payment
       $product->is_available = false;
       $product->save();
       
       // Redirect to the product list with a success message
       return redirect()->route('products.index')->with('success', 'Payment successful! The product is no longer available.');
   }
   

    // Display products by category
    public function category($category)
    {
        $products = Product::where('category', $category)->get();
        return view('products.category', compact('products', 'category'));
    }

    

    // Display products in specific categories (additionally)
    public function hats()
    {
        return $this->category('hats');
    }

    public function tshirts()
    {
        return $this->category('tshirts');
    }

    public function electronics()
    {
        return $this->category('electronics');
    }

    public function cosmetics()
    {
        return $this->category('cosmetics');
    }
}
