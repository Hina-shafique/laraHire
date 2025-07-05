<h2 class="text-2xl font-bold mb-4">Your Active Jobs</h2>

@foreach($posts as $post)
    <div class="bg-white rounded shadow p-4 mb-4">
        <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>
        <p>{{ $post->timeline }}</p>
        <p>Deadline: {{ $post->deadline}}</p>

        <a href='{{ route('submit.work', $post->id) }}' class="text-blue-600 underline mt-2 inline-block">
            Submit Work
        </a>
    </div>
@endforeach
