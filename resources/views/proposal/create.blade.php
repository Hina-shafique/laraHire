<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Submit a Proposal
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 shadow-md rounded-lg space-y-8">
        <!-- Post Details -->
        <div>
            <h3 class="text-lg font-bold text-gray-700 mb-2">Post Details</h3>
            <p class="text-xl font-semibold text-indigo-700">{{ $post->title }}</p>
            <p class="text-gray-600 mt-1">{{ Str::limit($post->description, 100) }}</p>
            <a href="{{ route('freelancer.display', $post->id) }}"
                class="inline-block mt-3 px-4 py-2 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-500 transition">
                View Post
            </a>
        </div>

        <!-- Proposal Form -->
        <form action="{{ route('proposal.store', $post->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 max-w-4xl mx-auto">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Cover Letter -->
            <div>
                <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover Letter</label>
                <textarea name="message" id="message" rows="5"
                    class="mt-1 w-full border border-gray-300 rounded-md p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                    placeholder="Write your proposal here..."></textarea>
            </div>

            <!-- File Attachment -->
            <div>
                <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment (optional)</label>
                <input type="file" name="file_path" id="attachment"
                    class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm file:bg-indigo-600 file:text-white file:px-4 file:py-2 file:rounded file:cursor-pointer">
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="px-6 py-2 bg-black text-white rounded-md hover:bg-gray-500 shadow">
                    Send
                </button>
            </div>
            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>