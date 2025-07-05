<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Submit Work for: {{ $post->title }}</h2>

        <form action="{{ route('submit.store', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block font-medium mb-1">Message (optional)</label>
                <textarea name="message" rows="4" class="w-full border p-2 rounded"></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Upload File (PDF, ZIP, DOCX)</label>
                <input type="file" name="file" class="block w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit Work
            </button>
        </form>
    </div>
</x-app-layout>