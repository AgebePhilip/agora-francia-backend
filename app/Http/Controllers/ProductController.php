<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_auction' => 'required|boolean',
            'auction_start_date' => 'nullable|date',
            'auction_end_date' => 'nullable|date',
            'is_negotiable' => 'required|boolean',
            'negotiation_price' => 'nullable|numeric',
        ]);

        // Extract data
        $data = $request->only([
            'name',
            'description',
            'price',
            'is_auction',
            'auction_start_date',
            'auction_end_date',
            'is_negotiable',
            'negotiation_price',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/products');
            $data['photo'] = Storage::url($photoPath);
        }

        // Create product
        $product = Product::create($data);

        return response()->json($product, 201);
    }

    // Get all products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Get a product by ID
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_auction' => 'required|boolean',
            'auction_start_date' => 'nullable|date',
            'auction_end_date' => 'nullable|date',
            'is_negotiable' => 'required|boolean',
            'negotiation_price' => 'nullable|numeric',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->only([
            'name',
            'description',
            'price',
            'is_auction',
            'auction_start_date',
            'auction_end_date',
            'is_negotiable',
            'negotiation_price',
        ]));

        if ($request->hasFile('photo')) {
            try {
                $photoPath = $request->file('photo')->store('public/products');
                $data['photo'] = Storage::url($photoPath);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error uploading photo', 'error' => $e->getMessage()], 500);
            }
        }

        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete the photo file if exists
        if ($product->photo) {
            Storage::delete(str_replace('/storage', 'public', $product->photo));
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
