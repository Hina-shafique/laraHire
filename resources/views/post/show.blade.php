<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8 space-y-6 border border-gray-200">

        <!-- Job Description -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-1">Job Description</h3>
            <p class="text-gray-600 leading-relaxed">{{ $post->description }}</p>
        </div>

        <!-- Price & Timeline -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-gray-700">
            <div>
                <span class="font-semibold">Price:</span> ${{ $post->price }}
            </div>
            <div>
                <span class="font-semibold">Timeline:</span> {{ $post->timeline }}
            </div>
        </div>

        <span
            class="px-3 py-1 text-sm font-medium rounded-full 
            {{ $post->status === 'open' ? 'bg-green-100 text-green-800' : ($post->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-300 text-gray-700') }}">
            {{ ucfirst($post->status) }}
        </span>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center gap-4 pt-4 border-t border-gray-100">

            <!-- Edit -->
            <a href="{{ route('posts.edit', $post->id) }}"
                class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500 transition">
                ✏️ Edit Post
            </a>

            <!-- Go Back -->
            <a href="{{ route('posts.index') }}"
                class="inline-block px-4 py-2 bg-gray-100 text-gray-800 border border-gray-300 rounded hover:bg-gray-200 transition">
                ← Go Back
            </a>

            <!-- Delete -->
            <form action="{{ route('posts.delete', $post->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this post?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    🗑️ Delete
                </button>
            </form>
        </div>

    </div>
</x-app-layout>