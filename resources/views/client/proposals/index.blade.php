<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Proposals for: {{ $post->title }}</h2>
    </x-slot>

    <div class="py-6 px-4">
        @forelse($post->proposals as $proposal)
            <div class="border p-4 mb-4 bg-white">
                <p><strong>Freelancer:</strong> {{ $proposal->user->name }}</p>
                <p><strong>Description:</strong> {{ $proposal->message }}</p>
            </div>

            <form action="{{ route('client.hire.freelancer', $proposal->id) }}" method="POST">
                @csrf
                <button type="Submit" class="mt-6 inline-block border border-gray-300 font-bold px-2 py-1 rounded hover:bg-gray-100 transition">Hire</button>
            </form>
        @empty
            <p>No proposals found for this post.</p>
        @endforelse
    </div>
</x-app-layout>
