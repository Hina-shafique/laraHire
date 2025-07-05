<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Rate the Freelancer</h2>

        <form method="POST" action="{{ route('client.submit.rating', $post) }}">
            @csrf
            <div class="mb-4">
                <label for="rating" class="block font-medium mb-1">Rating (1–5):</label>
                <select name="rating" id="rating" class="w-full border p-2 rounded" required>
                    <option value="">-- Select Rating --</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit Rating
            </button>
        </form>
    </div>
</x-app-layout>