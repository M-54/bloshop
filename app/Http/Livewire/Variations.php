<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductVariation;
use Livewire\Component;

class Variations extends Component
{

    public Product $product;
    public $variations;

    public function render()
    {
        return view('livewire.variations');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->variations = $product->variations->toArray();
    }

    public function add() {
        $this->variations[] = new ProductVariation();
    }

    public function save()
    {
        foreach ($this->variations as &$variation) {
            $variation['id'] = $this->product->variations()->updateOrCreate(
                ['id' => $variation['id'] ?? ''],
                $variation
            )->id;
        }
    }
}
