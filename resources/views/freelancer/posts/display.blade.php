<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <p class="text-gray-700">{{ $post->description }}</p>
        <p class="text-sm text-gray-500">Budget: ${{ $post->price }} | Timeline: {{ $post->timeline }}</p>
    </div>

    <a href="{{ route('proposal.create', $post->id) }}" class="m-6 inline-block border border-gray-300 font-bold px-2 py-1 rounded hover:bg-gray-100 transition">
        Send Proposal
    </a>
</x-app-layout>
