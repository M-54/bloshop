<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class Cart extends Component
{

    public $count = 0;

    protected $listeners = [
        'updateCart' => 'updateCount',
    ];

    public function render()
    {
        return view('livewire.products.cart');
    }

    public function mount()
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $value) {
            foreach ($value['variations'] as $key2 => $variation) {
                $this->count += $variation['count'];
            }
        }
    }

    public function updateCount()
    {
        $this->count = 0;
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $value) {
            foreach ($value['variations'] as $key2 => $variation) {
                $this->count += $variation['count'];
            }
        }
    }
}
