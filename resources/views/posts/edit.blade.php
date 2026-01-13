<x-app-layout>
    <x-slot name="header">
        Edit Post
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold">Title</label>
                <input type="text" name="title"
                    class="border w-full p-2"
                    value="{{ old('title', $post->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <input type="file" name="image" accept="image/*">
            @error('image')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <div class="mb-4">
                <label class="block font-semibold">Image Preview</label>
                @if ($post->image)
                    <img  src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-32 h-32 object-cover mt-2">
                @endif
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Content</label>
                <textarea name="content"
                    class="border w-full p-2"
                    rows="6">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update Post
            </button>
        </form>
    </div>
</x-app-layout>
