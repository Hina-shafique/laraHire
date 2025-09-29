<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Proposals</h2>
    </x-slot>

    <div class="p-6">
        @forelse($proposals as $proposal)
            <div class="border p-4 mb-4 rounded bg-white">
                <h3 class="text-lg font-semibold">{{ $proposal->post->title }}</h3>
                <p><strong>Status:</strong> {{ ucfirst($proposal->post->status ?? 'pending') }}</p>
                <p><strong>Message:</strong> {{ $proposal->message }}</p>
                
                @if($proposal->file_path)
                    <a href="{{ asset('storage/' . $proposal->file_path) }}" class="text-blue-500 underline" download>
                        Download Attached File
                    </a>
                @endif
            </div>
        @empty
            <p>You haven’t submitted any proposals yet.</p>
        @endforelse
    </div>
</x-app-layout>
