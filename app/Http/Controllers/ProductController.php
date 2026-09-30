<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\ProductSerial;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('stock')->paginate(10);

        $serialNumbers = collect(); // empty collection
        
        return view('admin.products', compact('products', 'serialNumbers'));
    }

    // In your ProductController
    public function showProductSerials($productId)
{
    $product = Product::findOrFail($productId);
    $serialNumbers = ProductSerial::where('product_id', $productId)->get();

    return view('admin.products', compact('product', 'serialNumbers'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string|max:255',
            'model_name' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'horsepower' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'stock_quantity' => 'nullable|numeric|min:0',
            'reorder_level' => 'required|integer|min:0', 
            'prefix' => 'nullable|string|max:10',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Create the product first
        $product = Product::create([
            'name' => $data['name'],
            'model_name' => $data['model_name'],
            'type' => $data['type'],
            'horsepower' => $data['horsepower'],
            'brand' => $data['brand'],
            'image' => $data['image'] ?? null,  // image is optional, hence the fallback to null
            'price' => $data['price'],
            'description' => $data['description'],
            'prefix' => $request->prefix ?? null,
        ]);

        // AUTO GENERATED SERIAL BY QUANTITY LOOP
        // Then, associate the stock with the newly created product
       //  $stockQuantity = $request->stock_quantity ?? 0;

        $product->stock()->create([
         //   'quantity' => $stockQuantity,
            'reorder_level' => $request->reorder_level,
        ]);

           // Generate serial numbers
      //  $quantity = $stockQuantity; // how many serial numbers to generate

      //  $prefix = $request->prefix;

      //  for ($i = 1; $i <= $quantity; $i++) {
       //     $serialNumber = $prefix . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Store each serial number in the product_serials table
       //     ProductSerial::create([
        //        'product_id' => $product->id,
         //       'serial_number' => $serialNumber,
         //       'status' => 'available', // initial status
         //   ]);
       // } //

        
        return redirect()->route('products')->with('success', 'Product has been added!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model_name' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'horsepower' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            
        ]);

        $product = Product::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

    

       // Update the product with the new data
        $product->update([
            'name' => $data['name'],
            'model_name' => $data['model_name'],
            'type' => $data['type'],
            'horsepower' => $data['horsepower'],
            'brand' => $data['brand'],
            'image' => $data['image'] ?? $product->image,  // Use existing image if none is uploaded
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        // Update the stock associated with the product
       // if ($product->stock) {
       //    // Update stock quantity if it exists
       //    $product->stock()->update([
       //       'quantity' => $request->stock_quantity,
       //       ]);
       // } else {
            // If no stock entry exists, create a new one
       //     $product->stock()->create([
       //         'quantity' => $request->stock_quantity,
       //     ]);
       // }

        return redirect()->route('products')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product has been deleted!');
    }
}
