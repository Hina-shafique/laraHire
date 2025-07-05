<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Review Work Submitted for: {{ $post->title }}</h2>

        <p><strong>Freelancer:</strong> {{ $submission->user->name }}</p>
        <p><strong>Message:</strong> {{ $submission->message ?? 'No message provided.' }}</p>

        @if($submission->file_path)
            <p><strong>Attached File:</strong>
                <a href="{{ asset('storage/' . $submission->file_path) }}" class="text-blue-600 underline" target="_blank">
                    View File
                </a>
            </p>
        @endif

        <form method="POST" action="{{ route('submitConfirm', $post) }}">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Submit & Confirm
            </button>
        </form>
    </div>
</x-app-layout>