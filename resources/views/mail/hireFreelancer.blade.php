<h2>Congratulations, {{ $proposal->user->name }}!</h2>

<p>You've been hired for the job: <strong>{{ $proposal->post->title }}</strong>.</p>

<p>Client Message:</p>
<p>{{ $proposal->message }}</p>

<p>Please check your dashboard to begin working.</p>