<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Job') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-10">
        <form action={{ route('posts.store') }} method="POST"
            class="bg-white shadow-md rounded-lg w-full max-w-xl p-8 space-y-6 border border-gray-200">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" placeholder="Add title"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>

            <!-- Description -->
            <div class="relative">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Add job description"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>

                <button id="generateBtn" type="button"
                    class="absolute bottom-2 right-2 px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-500 transition">
                    Generate with AI
                </button>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" placeholder="Add price"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>

            <!-- Timeframe -->
            <div>
                <label for="timeline" class="block text-sm font-medium text-gray-700">Timeframe</label>
                <input type="text" name="timeline" id="timeline" placeholder="E.g. 5 days"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('posts.index') }}"
                    class="inline-block px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 text-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-block px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-500 text-sm font-medium shadow-sm">
                    Save
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
    <script>
        const messageField = document.getElementById('description');
        const button = document.getElementById('generateBtn');
        const titleField = document.getElementById('title');

        button.addEventListener('click', async () => {
            button.disabled = true;
            messageField.value = 'Generating...';

            try {
                const response = await fetch('{{ route('post.generate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        title: titleField.value
                    })
                });
                const data = await response.json();

                messageField.value = data.post || 'Failed to generate proposal. Please try again.';

                button.style.display = 'none';
            } catch (error) {
                messageField.value = 'Error generating proposal. Please try again.';
                button.disabled = false;
            }
        });
    </script>
</x-app-layout>