<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cart = session()->get('cart', []);

        $my_cart = [];
        foreach ($cart as $key => $value) {
            foreach ($value['variations'] as $key2 => $variation) {
                $my_cart[] = [
                    'variation' => $variation['variation'],
                    'count' => $variation['count'],
                    'total_price' => $variation['variation']['price'] * $variation['count'],
                ];
            }
        }

        return view('shop.cart', compact('my_cart'));
    }
}
