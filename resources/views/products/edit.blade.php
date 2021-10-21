<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit') }}
            </h2>

            <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
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
                <form action="{{ route('products.update', $product) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="p-6 space-y-8">

                        <div class="form-control">
                            <label class="label" for="title">
                                <span class="label-text">Title</span>
                            </label>
                            <input type="text" name="title" id="title" placeholder="Title" class="input input-bordered"
                                   required value="{{ old('title', $product->title) }}">
                        </div>

                        <div class="form-control">
                            <label class="label" for="title_en">
                                <span class="label-text">English Title</span>
                            </label>
                            <input type="text" name="title_en" id="title_en" placeholder="English Title"
                                   class="input input-bordered"
                                   required value="{{ old('title_en', $product->title_en) }}">
                        </div>

                        <div class="form-control">
                            <label class="label" for="content">
                                <span class="label-text">Content</span>
                            </label>
                            <textarea name="content" id="content" class="textarea textarea-bordered"
                                      placeholder="Content" rows="8"
                                      required>{{ old('content', $product->content) }}</textarea>
                        </div>

                        <div class="p-4 bg-blue-200">
                            <h2 class="mb-3">Variations</h2>
                            <livewire:variations :product="$product"/>
                        </div>

                        <button type="submit" class="btn btn-lg w-full">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
