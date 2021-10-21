<div class="space-y-4">
    <button type="button" class="btn w-full" wire:click="add">Add</button>

    @foreach ($variations as $variation)
        <div class="grid grid-flow-col auto-cols-auto gap-4" wire:key="{{ $loop->index }}">
            <input type="text" class="input input-bordered" placeholder="Name"
                   wire:model.defer="variations.{{ $loop->index }}.name">
            <input type="number" class="input input-bordered" placeholder="Count" min="1"
                   wire:model.defer="variations.{{ $loop->index }}.count">
            <input type="number" class="input input-bordered" placeholder="Price"
                   wire:model.defer="variations.{{ $loop->index }}.price">
        </div>
    @endforeach

    @if(count($variations) > 0)
        <button type="button" class="btn w-full" wire:click="save">Save</button>
    @endif
</div>
