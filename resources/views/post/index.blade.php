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
                <p class="mb-2"><strong>Total Jobs You Create:</strong> 6 </p>
            </x-aside-box>

            <x-aside-box :title="'Active Jobs'">
                <p class="mb-2"><strong>Your Active Jobs are:</strong> 4</p>
            </x-aside-box>

            <x-aside-box :title="'Total Spend'">
                <p class="mb-2"><strong>Your Total Spend:</strong> $200</p>
            </x-aside-box>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-6">
            <!-- Input Box -->
            <div class="w-full max-w-3xl space-y-4">
                <ul class="list-disc pl-5 space-y-4">
                    @foreach ($posts as $post)
                        <x-main-input-box>
                            <li>
                                <div class="">
                                    <a href="" class="{{ $post->status ? 'text-xl font-semibold' : 'text-gray-700' }}">
                                        {{ $post->title }}
                                    </a>
                                    <p class="text-sm text-gray-300">
                                        Fixed-price · Intermediate · Est. Budget: <span
                                            class="font-semibold">${{ $post->price }}</span>
                                    </p>
                                </div>
                                <div class="text-sm text-gray-600 leading-relaxed mt-6">
                                    {{ $post->description }}
                                </div>
                                <a href="#"
                                    class="mt-6 inline-block border border-gray-300 font-bold px-2 py-1 rounded hover:bg-gray-100 transition">
                                    Edit Post
                                </a>
                            </li>
                        </x-main-input-box>
                    @endforeach
                </ul>
            </div>
        </main>
    </div>
</x-app-layout>