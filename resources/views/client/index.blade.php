<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="flex h-screen">
        <!--side bar -->
        <aside class="w-64 flex flex-col p-4 space-y-4">
            <h2 class="text-xl font-semibold mb-4">Profile</h2>
            <h3 class="text-lg font-semibold mb-2">Posted Projects</h3>
            <hr class="mb-2">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <hr>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <hr>
            <p><strong>Location:</strong> {{ $client->location }}</p>
            <hr>
            <p><strong>Languages:</strong> {{ $client->language }}</p>
        </aside>

            <!-- Main Content -->
        <main class="flex-1 flex flex-col items-center justify-center px-6">

            <!-- Input Box -->
            <div class="w-full max-w-xl">
                <form class="bg-gray-800 rounded-full px-6 py-3 flex items-center gap-4 shadow-lg">
                    <input 
                        type="text" 
                        placeholder="Post Job" 
                        class="bg-transparent text-black w-full focus:outline-none placeholder-gray-400"
                    >
                    <button type="submit" class="text-green-400 hover:text-green-300">
                        <!-- Submit icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>
