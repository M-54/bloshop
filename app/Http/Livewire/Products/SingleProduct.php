<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\ProductVariation;
use Livewire\Component;

class SingleProduct extends Component
{

    public Product $product;
    public $selected_variation;
    public $variation;

    public function render()
    {
        return view('livewire.products.single-product');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->variation = $product->variations()->orderBy('price')->first();
    }

    public function addToCart($id)
    {
        if (is_null($this->selected_variation)) return;

        $cart = session()->get('cart', []); // get cart from session

        if (array_key_exists($id, $cart)) {
            if (array_key_exists($this->selected_variation, $cart[$id]['variations']))
                $cart[$id]['variations'][$this->selected_variation]['count'] += 1;
            else
                $cart[$id]['variations'][$this->selected_variation] = [
                    'variation' => ProductVariation::findOrFail($this->selected_variation),
                    'count' => 1
                ];
        } else {
            $cart[$id] = [
                'product' => Product::findOrFail($id),
            ];
            $cart[$id]['variations'][$this->selected_variation] = [
                'variation' => ProductVariation::findOrFail($this->selected_variation),
                'count' => 1
            ];
        }

        session()->put('cart', $cart); // update cart in session

        $this->emit('updateCart');
    }

    public function updatedSelectedVariation($value)
    {
        $this->variation = ProductVariation::findOrFail($value);
    }
}
