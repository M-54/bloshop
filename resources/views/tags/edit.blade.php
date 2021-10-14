<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit') }}
            </h2>

            <a href="{{ route('catag.index') }}" class="btn btn-primary">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 space-y-6">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-error">
                            <div class="flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     class="w-6 h-6 mx-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                </svg>
                                <label>{{ $error }}</label>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('tags.update', $tag) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="p-6 space-y-8">
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Title</span>
                            </label>
                            <input type="text" name="title" id="name" placeholder="Title" class="input input-bordered"
                                   required value="{{ old('title', $tag->title) }}">
                        </div>

                        <button type="submit" class="btn btn-lg w-full">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
