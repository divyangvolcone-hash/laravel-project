<x-app-layout>
    <x-slot name="header">
        Create Post
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold">Title</label>
                <input type="text" name="title"
                    class="border w-full p-2"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <input type="file" name="image" accept="image/*">
            <div class="mb-4">
                <label class="block font-semibold">Image URL</label>
                <input type="text" name="image_url"
                    class="border w-full p-2"
                    value="{{ old('image_url') }}">
                @error('image_url')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Content</label>
                <textarea name="content"
                    class="border w-full p-2"
                    rows="6">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Publish
            </button>
        </form>
    </div>
</x-app-layout>
