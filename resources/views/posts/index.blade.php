<x-app-layout>
    <x-slot name="header">
        All Posts  @auth
            <a href="{{ route('posts.create') }}"
               class="text-blue-500 px-4 py-2 rounded">
                Add New Post
            </a>
        @endauth
    </x-slot>
    <div class="max-w-4xl mx-auto py-10">

        <!-- Create Table structure for admin listing with Actions view Edit Delete -->
        <table class="min-w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Title</th>
                    <th class="border px-4 py-2">Content</th>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Author</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Check if posts not exist then show no posts found -->
                @if($posts->isEmpty())
                    <tr>
                        <td colspan="4" class="border px-4 py-2 text-center">No posts found.</td>
                    </tr>
                @else
                    @foreach($posts as $post)
                        <tr>
                            <td class="border px-4 py-2">{{ $post->title }}</td>
                            <td class="border px-4 py-2">{{ Str::limit($post->content, 10) }}</td>
                            <td class="border px-4 py-2">
                                
                                @if($post->image)
                                    <img  src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-16 h-16 object-cover" onerror="this.onerror=null;this.src='https://placehold.co/600x400';">
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $post->user ? $post->user->name : '-' }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('posts.show', $post) }}"
                                class="text-blue-500 mr-2">View</a>
                                <a href="{{ route('posts.edit', $post) }}"
                                class="text-green-500 mr-2">Edit</a>
                                <!-- Method to clone post -->

                                <form action="{{ route('posts.clone', $post) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="text-purple-500 mr-2">
                                        Clone
                                    </button>   
                                </form>

                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500"
                                            onclick="return confirm('Are you sure you want to delete this post?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
