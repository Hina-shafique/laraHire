<h2 class="text-2xl font-bold mb-4">Your Active Jobs</h2>

@foreach($posts as $post)
    <div class="bg-white rounded shadow p-4 mb-4">
        <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>

        <p class="mt-2 text-sm text-gray-600">Deadline: {{ $post->deadline->format('d M Y h:i A') }}</p>

        <div class="text-red-600 font-bold mt-1" id="countdown-{{ $post->id }}"
            data-deadline="{{ $post->deadline->toIso8601String() }}">
        </div>

        <a href='' class="text-blue-600 underline mt-2 inline-block">
            Submit Work
        </a>
    </div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countdowns = document.querySelectorAll('[id^="countdown-"]');

        countdowns.forEach(el => {
            const deadline = new Date(el.getAttribute('data-deadline')).getTime();

            const interval = setInterval(() => {
                const now = new Date().getTime();
                const distance = deadline - now;

                if (distance < 0) {
                    el.innerText = '⏰ Time is up!';
                    clearInterval(interval);
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                el.innerText = `⏳ ${days}d ${hours}h ${minutes}m ${seconds}s left`;
            }, 1000);
        });
    });
</script>