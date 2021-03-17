<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductMovementRequest;

class MovementController extends Controller
{
    public function addMovement(ProductMovementRequest $request)
    {
        try {
            $data = $request->all();
            $product = Product::find($request->id);
            $product->quantities()->create($data);

            
            return Redirect::route('products.view', $product->id)->with('success', 'Movement created successfully!');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error has occurred, please try again later.'
            ], 500);
        }
    }
}
