<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Browse Jobs</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @foreach ($posts as $post)
            @php
                $alreadyApplied = $post->proposals->contains('user_id', auth()->id());
            @endphp

            <div class="relative bg-white p-4 border border-gray-200 rounded shadow">
                {{-- Applied badge --}}
                @if ($alreadyApplied)
                    <div class="absolute top-0 right-0 mt-2 mr-2 bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full shadow">
                        Applied
                    </div>
                @endif

                <h3 class="text-lg font-bold">{{ $post->title }}</h3>
                <p class="text-gray-600">{{ Str::limit($post->description, 100) }}</p>
                <p class="text-sm text-gray-500">
                    Budget: ${{ $post->price }} |
                    Timeline: {{ $post->timeline }}
                </p>
                <a href="{{ route('freelancer.display', $post->id) }}"
                   class="mt-2 inline-block text-indigo-600 hover:underline">
                    View Details
                </a>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
