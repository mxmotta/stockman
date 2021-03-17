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

        $products = $products->map(function ($product, $index) {
            $product['total'] = $product->total;
            return $product;
        });

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

            foreach ($data as $item) {
                $product = Product::create($item);
                $product->quantities()->create(['quantity' => $item['quantity'], 'type' => 'in']);
            }

            return Redirect::route('products.list')->with('success', 'Product(s) stored successfully!');
        } catch (\Exception $e) {
            return Redirect::route('products.add')->with('error', 'An error has occurred, plase try again later.');
        }
    }

    public function view(Request $request)
    {
        $product = Product::find($request->id);
        $product['total'] = $product->total;
// dd($product->quantities->sortByDesc('created_at'));
        return Inertia::render('Products/View', [
            'product' => $product,
            'historic' => $product->quantities->sortByDesc('created_at')
        ]);
    }
    public function edit(Request $request)
    {
        $product = Product::find($request->id);

        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $product = Product::find($request->id);
            $product->fill($data)->save();

            return Redirect::route('products.list', $product->id)->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return Redirect::route('products.edit', $product->id)->with('error', 'An error has occurred, please try again later');
        }
    }

    public function movement(Request $request)
    {
        try {
            $data = $request->all();
            $product = Product::find($request->id);
            $product->quantities()->create($data);

            return response()->json([
                'message' => 'Product changed successfully.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error has occurred, please try again later.'
            ], 500);
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
