<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Welcome') }} {{ $user->name }}
            </h2>

            <!-- Notification Bell with Dropdown -->
            <div class="relative" x-data="{
         open: false,
         markRead() {
             if (!this.open) {
                 fetch('{{ route('notifications.markRead') }}', {
                     method: 'POST',
                     headers: {
                         'X-CSRF-TOKEN': '{{ csrf_token() }}',
                         'Accept': 'application/json',
                     }
                 });
             }
         }
     }">

                <!-- Bell Icon Button -->
                <button @click="open = !open; markRead()" class="relative focus:outline-none">
                    🔔
                    @if($user->unreadNotifications->count())
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1">
                            {{ $user->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                <!-- Dropdown Box -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg z-50 border border-gray-200 p-4 max-h-96 overflow-y-auto">

                    <h3 class="font-semibold text-gray-700 mb-2">Notifications</h3>

                    @forelse($user->notifications as $notification)
                        <div class="border-b border-gray-200 pb-2 mb-2">
                            <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>
                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No notifications yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
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
                <x-main-input-box :href="route('freelancer.explore')">View All Jobs</x-main-input-box>
                <x-main-input-box :href="route('freelancer.active')">View Your Active Jobs</x-main-input-box>
                <x-main-input-box :href="route('proposal.index')">View Your Proposals</x-main-input-box>
            </div>
        </main>
    </div>
</x-app-layout>