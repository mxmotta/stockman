<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
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

    public function add()
    {
        return Inertia::render('Products/Add');
    }

    public function store(ProductAddRequest $request)
    {
        try {
            $data = $request->all();
            Product::insert($data);

            return Redirect::route('products.list')->with('success', 'Product(s) stored successfully!');
        } catch (\Exception $e) {

            return Redirect::route('products.add')->with('error', 'An error has occurred, plase try again later.');
            
        }
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
