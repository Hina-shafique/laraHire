<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex bg-gray-100 pt-4 px-6">
        <aside class="w-64 flex-shrink-0 flex flex-col p-4 space-y-6 border border-gray-300 bg-white shadow-md">
            <x-aside-box :title="'Profile'">
                <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                <hr>
                <p class="mb-2 mt-2"><strong>Email:</strong> {{ $user->email }}</p>
                <hr>
                <p class="mb-2 mt-2"><strong>Location:</strong> {{ $client->location }}</p>
                <hr>
                <p class="mt-2"><strong>Languages:</strong> {{ $client->language }}</p>
            </x-aside-box>

            <x-aside-box :title="'Active Jobs'">
                <p class="mb-2"><strong>Your Active Jobs are:</strong> {{ $client->post ?? 0 }}</p>
            </x-aside-box>

            <x-aside-box :title="'Total Spend'">
                <p class="mb-2"><strong>Your Total Spend:</strong> $.{{ $user->posts->sum('price') }}</p>
            </x-aside-box>
        </aside>

        <main class="flex-1 px-6">
            <div class="w-full max-w-3xl space-y-4">
                <x-main-input-box :href="route('post.create')">Add New Job</x-main-input-box>
                <x-main-input-box :href="route('posts.index')">View All Jobs</x-main-input-box>
                <x-main-input-box :href="route('posts.index')">View Active Jobs</x-main-input-box>
            </div>
        </main>
    </div>
</x-app-layout>