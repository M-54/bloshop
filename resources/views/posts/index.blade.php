<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>

            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
                <div class="alert alert-success mb-6">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             class="w-6 h-6 mx-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <label>{{ session('message') }}</label>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.index') }}" class="p-4 w-full grid auto-cols-auto grid-flow-col gap-4 items-end">
                    <input type="text" name="title" id="title" placeholder="Title" class="input input-bordered"
                               value="{{ old('title', request('title')) }}">

                    <select name="status" class="select select-bordered w-full">
                        <option value="all" selected="selected">All</option>
                        <option value="draft" @if(request('status') == 'draft') selected @endif>Draft</option>
                        <option value="published" @if(request('status') == 'published') selected @endif>Published</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <table class="table w-full table-zebra">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->author->name }}</td>
                            <td>{{ strtoupper($post->status) }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-xs">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{--                {{ $posts->links('pagination.custom-pagination') }}--}}
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
