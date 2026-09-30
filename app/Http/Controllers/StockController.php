<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch stock data with associated product where the product is not deleted
        $stocks = Stock::with('product')->whereHas('product', function ($query) {
            $query->whereNull('deleted_at'); // Only include products that are not deleted
        })->get();
    
        // Get all products for the dropdown (this can also be filtered if you want only active products in the dropdown)
        $products = Product::whereNull('deleted_at')->get(); // Only active products for dropdown
    
        return view('admin.inventory', compact('stocks', 'products'));
    }
    

    
    public function add(Request $request)
{
    $request->validate([
        'serial_number' => 'required|unique:product_serials,serial_number',
        'product_id' => 'required|exists:products,id',
    ]);
    

    // Save the serial number
    ProductSerial::create([
        'product_id' => $request->product_id,
        'serial_number' => $request->serial_number,
        'status' => 'available', // or whatever your default is
    ]);

    // Update stock quantity for the product
    $stock = Stock::where('product_id', $request->product_id)->first();
    $stock->increment('quantity');

    return back()->with('success', 'Serial number added and stock updated.');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all products to associate with stock
        $products = Product::all();
        return view('admin.inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'reorder_level' => 'required|integer|min:0', // Validate reorder level
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if the stock exists for the product
        if ($product->stock) {
            // Update the stock with the new quantity and reorder level
            $product->stock()->update([
                'reorder_level' => $request->reorder_level,
            ]);
        } else {
            // Create new stock for the product
            $product->stock()->create([
                'reorder_level' => $request->reorder_level, // Set the reorder level
            ]);
        }

        return redirect()->route('inventory')->with('success', 'Stock added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // This can be used for detailed view if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::all();
        $stock = Stock::findOrFail($id); // Fetch the stock by ID
        return view('admin.inventory.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'reorder_level' => 'required|integer|min:0', // Validate reorder level
        ]);

        $stock = Stock::findOrFail($id); // Find stock by ID

        // Update the stock with the new quantity and reorder level
        $stock->update([
            'reorder_level' => $request->reorder_level, // Update reorder level
        ]);

        return redirect()->route('inventory')->with('success', 'Stock successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('inventory')->with('success', 'Stock deleted successfully');
    }
}
