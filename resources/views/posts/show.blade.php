<x-guest-layout>
    <div class="max-w-4xl mx-auto py-10">
        <p class="text-gray-700 leading-relaxed">
            @if($post->image)
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="mb-4 w-full h-auto">
            @endif
        </p>
        <h1 class="text-3xl font-bold mb-4">
            {{ $post->title }}
        </h1>
        
        <p class="text-gray-700 leading-relaxed">
            {{ $post->content }}
        </p>

        <a href="{{ route('posts.index') }}"
           class="text-blue-500 mt-6 inline-block">
            ← Back to Blog
        </a>

    </div>
</x-guest-layout>
