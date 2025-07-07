<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">My Posted Jobs</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">

        @if ($posts->isEmpty())
            <div class="text-center text-gray-600">
                <p>You haven't created any posts yet.</p>
                <a href="{{ route('post.create') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
                    Create Your First Post
                </a>
            </div>
        @else
            @foreach ($posts as $post)
                <div class="border-b border-gray-200 py-4">
                    <h3 class="text-lg font-bold text-indigo-700">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ Str::limit($post->description, 100) }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="text-sm text-blue-500 underline">View Details</a>
                </div>
            @endforeach
        @endif

    </div>
</x-app-layout>
