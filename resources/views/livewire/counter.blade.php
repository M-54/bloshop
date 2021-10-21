<div class="p-5">
    <div wire:offline>
        You are now offline.
    </div>

    <p>{{ $counter }}</p>

    <button class="btn" wire:click="add">Add</button>

    <hr>

    <h1>{{ $name }}</h1>

    <input type="text" wire:offline.class="bg-red-300" wire:model.debounce.1s="name">

    <hr>

    <ul>
        @foreach($tasks as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    <form wire:submit.prevent="addTask">
        <input type="text" wire:model="task">
        <button type="submit" class="btn">ADD Task</button>
    </form>
</div>
