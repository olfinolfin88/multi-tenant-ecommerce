<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cart = $user->cart()->with('items.product')->first();

        return Inertia::render('Cart', [
            'cart' => $cart
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $user = Auth::user();

        $cart = Cart::firstOrCreate(['user_id'  => $user->id]);

        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        } else {
            $cart->items()->create([
                'product_id'    => $request->product_id,
                'quantity'      => $request->quantity ?? 1,
            ]);
        }
        return back()->with('message', 'Product has been success add to cart!');
    }

    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return back()->with('message', 'Item has been removed from the cart.');
    }
}
