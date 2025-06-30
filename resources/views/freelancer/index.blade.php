<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex bg-gray-100 pt-4 px-6">

        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0 flex flex-col p-2 space-y-6 border border-gray-300 bg-white shadow-md">
            <x-aside-box :title="'Profile'">
                <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                <hr>
                <p class="mb-2 mt-2"><strong>Email:</strong> {{ $user->email }}</p>
                <hr>
                <p class="mb-2 mt-2"><strong>Description:</strong> {{ $freelancer->description }}</p>
                <hr>
                <p class="mt-2"><strong>Language:</strong> {{ $freelancer->language }}</p>
            </x-aside-box>

            <x-aside-box :title="'Your Experience'">
                <p class="mb-2"><strong>Your Experience:</strong> {{ $freelancer->experience }}</p>
            </x-aside-box>

            <x-aside-box :title="'Your Skills'">
                <p class="mb-2"><strong>Your skills:</strong> {{ $freelancer->skills }}</p>
            </x-aside-box>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-6">
            <!-- Input Box -->
            <div class="w-full max-w-3xl space-y-4">
                <x-main-input-box :href="route('freelancer.explore')">Most Recent Jobs</x-main-input-box>
                <x-main-input-box>View All Jobs</x-main-input-box>
                <x-main-input-box>View Your Active Jobs</x-main-input-box>
            </div>
        </main>
    </div>
</x-app-layout>