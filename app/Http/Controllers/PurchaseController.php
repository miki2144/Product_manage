<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PurchaseController extends Controller
{
    // Display all purchases
    public function index()
    {
        $purchases = Purchase::with('product')->get();
        return view('purchases.index', compact('purchases'));
    }

    // Show the form for creating a new purchase
    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    // Store a new purchase in the database
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0'
        ]);

        Purchase::create([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'stripe_charge_id' => 'N/A' // If manually adding, no Stripe transaction
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase added successfully!');
    }

    // Show details of a specific purchase
    public function show($id)
    {
        $purchase = Purchase::with('product')->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    // Show the form for editing an existing purchase
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $products = Product::all();
        return view('purchases.edit', compact('purchase', 'products'));
    }

    // Update a purchase in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0'
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update([
            'product_id' => $request->product_id,
            'amount' => $request->amount
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
    }

    // Delete a purchase
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}
