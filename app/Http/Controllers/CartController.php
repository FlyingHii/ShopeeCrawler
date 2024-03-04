<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Load cart info of authenticated user. If user not authenticated, redirect to login page.
     *
     * */
    public function cart()
    {
        if(!Auth::user()) {
            return redirect()->route('login');
        }
        $cartInfo = User::query()->find(Auth::id())->cart;
        if($cartInfo) {
            $cartInfo = $cartInfo->load('products');
        }

        return view('cart', [
            'cart' => $cartInfo
        ]);
    }

    /**
     * Handle incoming request to increase or decrease product quantity of cart.
     *
     * */
    public function addProductToCart(Request $request)
    {
        $productId = $request->get('product_id');
        $product = Product::query()->find($productId);
        $quantity = $request->get('quantity');
        if(!Auth::user()) {
            return redirect(route('login'))->intended();
        }

        if(!$product) {
            throw new \Exception('Invalid product');
        }

        $cartInfo = $this->addToCart($productId, Auth::user()->getAuthIdentifier(), $quantity ?: 1);

        return view('cart', [
            'cart' => $cartInfo
        ]);
    }

    /**
     * Logic function to add one product to cart.
     * Cart is initialized if not exists.
     * Existed product in cart will be update quantity.
     * New product will be created in cart
     *
     * @return Cart
     * */
    private function addToCart(int $productId, int $userId, ?int $quantity): Cart
    {
        $cart = User::query()->find($userId)->cart;
        if (!$cart)
        {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->save();
        }

        $existProduct = $cart->products()
            ->wherePivot('product_id', $productId)
            ->first();

        if(!$existProduct)
        {
            $cart->products()->attach($productId, ['quantity' => $quantity]);
        } else {
            if ($existProduct->pivot->quantity+$quantity >= 0) {
                $cart->products()
                    ->wherePivot('product_id', $productId)
                    ->updateExistingPivot($existProduct, ['quantity' => $existProduct->pivot->quantity + $quantity]);
                $existProduct->quantity += $quantity;
            }
        }

        return $cart->load('products');
    }
}
