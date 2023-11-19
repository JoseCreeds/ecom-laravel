<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToBasket(Request $request)
    {
        //     // Start the session if not already started
        if (!$request->session()->has('panier')) {
            $request->session()->put('panier', []);
        }

        if (request()->has('id')) {
            $productId = request('id');

            $product = Product::findOrFail($productId);

            $basket = $request->session()->get('panier', []);

            if (array_key_exists($productId, $basket)) {
                // Product already exists in the basket, increment the quantity
                $basket[$productId]++;
            } else {
                // Product doesn't exist in the basket, add it with quantity 1
                $basket[$productId] = 1;
            }

            // Save the updated basket back to the session
            $request->session()->put('panier', $basket);
        }

        // Retrieve and display the current basket
        $currentBasket = $request->session()->get('panier', []);

        return redirect()->route('home')->with('currentBasket', $currentBasket);
    }

    public function deleteProduct(Request $request, int $productId)
    {
        $currentBasket = $request->session()->get('panier', []);

        unset($currentBasket[$productId]);

        session()->put('panier', $currentBasket);

        return redirect()->route('cart');
    }

    public function clearCart(Request $request)
    {

        $request->session()->flush();

        return redirect()->route('cart');
    }
}
