<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('items.product', 'items.size')
                ->where('user_id', auth()->id())
                ->first();
        
        $data = $cart->items->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->product_name,
                'color' => $item->product->color,
                'size' => $item->size->size_name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'image' => $item->product->image,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Cart Products retrieved successfully',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $item = $cart->items()
                ->where('product_id', $request->product_id)
                ->where('size_id', $request->size_id)
                ->first();

        if ($item) {
            $item->update(['quantity' => $item->quantity + $request->quantity]);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product successfully stored to cart',
            'data' => $cart,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);
        return response()->json([
            'status' => true,
            'message' => 'Cart updated successfully',
            'data' => $item,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = CartItem::findOrFail($id);
        $cart = $item->cart;
        $item->delete();
        return response()->json([
            'status' => true,
            'message' => 'Cart deleted successfully',
        ], 204);
    }
}
