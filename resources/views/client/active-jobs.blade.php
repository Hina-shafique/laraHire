<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">My Posted Jobs</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded mt-4 mb-2">

        @if ($posts->isEmpty())
            <div class="text-center text-gray-600">
                <p>You haven't created any posts yet.</p>
                <a href="{{ route('post.create') }}"
                    class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
                    Create Your First Post
                </a>
            </div>
        @else
            @foreach ($posts as $post)
                <div class="relative bg-white p-4 border border-gray-200 rounded shadow m-4">
                    <div>
                        <a href="{{ route('posts.show', $post->id) }}"
                            class="{{ $post->status ? 'text-xl font-bold' : 'text-gray-700' }}">
                            {{ $post->title }}
                        </a>
                        <span
                            class="px-3 py-1 text-sm font-medium rounded-full
                            {{ $post->status === 'open' ? 'bg-green-100 text-green-800' : ($post->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-300 text-gray-700') }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                    <p class="text-gray-600">{{ Str::limit($post->description, 100) }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="text-sm text-blue-500 underline">View Details</a>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>