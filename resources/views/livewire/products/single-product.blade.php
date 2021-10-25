<div class="card mb-4 rounded-3 shadow-sm">
    <div class="card-header py-3 position-relative">
        <h1 class="my-0 fw-normal h3">{{ $product->title }}</h1>

        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-uppercase">
            {{ $product->status }}
        </span>
    </div>
    <div class="card-body">
        <div class="ratio ratio-4x3 mb-3">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->images[0]->url) }}"
                 alt="{{ $product->title_en }}" style="object-fit: cover;">
        </div>
        <h4 class="card-title pricing-card-title">{{ number_format($variation->price ?? $product->price) }}T</h4>
        <select class="form-select mt-3 mb-4" wire:model="selected_variation">
            <option value="null" disabled>Select Variation</option>
            @foreach($product->variations as $variation)
                <option value="{{ $variation->id }}">{{ $variation->name }}</option>
            @endforeach
        </select>

        <div class="btn-group w-100" role="group" aria-label="Basic example">
            <button wire:click="addToCart({{ $product->id }})" type="button" class="btn btn-primary"
                    @if(is_null($selected_variation)) disabled @endif>
                Add to Cart
            </button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">View</a>
        </div>
    </div>
</div>
