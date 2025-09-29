<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Jobs') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex bg-gray-100 pt-4 px-6">

        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0 flex flex-col p-4 space-y-6 border border-gray-300 bg-white shadow-md">
            <x-aside-box :title="'Total Jobs'">
                <p class="mb-2"><strong>Total Jobs You Create:</strong> {{ $user->posts->count() }} </p>
            </x-aside-box>

            <x-aside-box :title="'Active Jobs'">
                <p class="mb-2"><strong>Your Active Jobs are:</strong> {{ $user->posts->whereIn('status', ['open', 'in_progress'])->count() }}</p>
            </x-aside-box>

            <x-aside-box :title="'Total Spend'">
                <p class="mb-2"><strong>Your Total Spend:</strong> $.{{ $user->posts->sum('price') }}</p>
            </x-aside-box>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-6">
            <!-- Input Box -->
            <div class="w-full max-w-3xl space-y-4">
                <ul class=" pl-5 space-y-4">
                    @foreach ($posts as $post)
                        <x-main-input-box>
                            <li>
                                <div>
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="{{ $post->status ? 'text-xl font-semibold' : 'text-gray-700' }}">
                                        {{ $post->title }}
                                    </a>
                                    <span
                                        class="px-3 py-1 text-sm font-medium rounded-full
                                            {{ $post->status === 'open' ? 'bg-green-100 text-green-800' : ($post->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-300 text-gray-700') }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-300">
                                        Fixed-price · Intermediate · Est. Budget: <span
                                            class="font-semibold">${{ $post->price }}</span>.
                                        Timline: {{ $post->timeline }}
                                    </p>
                                </div>
                                <div class="text-sm text-gray-600 leading-relaxed mt-6">
                                    {{ $post->description }}
                                </div>
                                @auth
                                @if (auth()->id() === $post->user_id)
                                <a href="{{ route('posts.edit', $post->id) }}"
                                    class="mt-6 inline-block border border-gray-300 font-bold px-2 py-1 rounded hover:bg-gray-100 transition">
                                    Edit Post
                                </a>
                                <a href="{{ route('posts.show', $post->id) }}"
                                    class="mt-6 inline-block border border-gray-300 font-bold px-2 py-1 rounded hover:bg-gray-100 transition">
                                    Show Post
                                </a>
                                <a href="{{ route('client.post.proposals', $post->id) }}"
                                    class="mt-6 inline-block border border-gray-300 font-bold px-2 py-1 rounded hover:bg-gray-100 transition">
                                    View Peoposals
                                </a>
                                @endif
                                @endauth
                            </li>
                        </x-main-input-box>
                    @endforeach
                </ul>
                <!-- Pagination links -->
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>