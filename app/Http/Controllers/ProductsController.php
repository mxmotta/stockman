<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductsController extends Controller
{
    public function list()
    {
        $products = Product::all();

        return Inertia::render('Products/List', [
            'products' => $products
        ]);
    }

    public function delete(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product->delete();

            return response()->json([
                'message' => 'Product deleted successfully.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error has occurred, please try again later.'
            ], 500);
        }
    }
}
