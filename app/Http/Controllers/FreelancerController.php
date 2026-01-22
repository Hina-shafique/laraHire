<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ensureUserIsFreelancer;
use Closure;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\freelancer;
use App\Models\post;
use App\Models\Client;
use App\Http\Requests\StorefreelancerRequest;
use App\Http\Requests\UpdatefreelancerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Http\Request;

class FreelancerController extends Controller implements HasMiddleware
{
    public function index()
    {
        $user = Auth::user();
        $freelancer = $user->freelancer;
        return view('freelancer.index', [
            'user' => $user,
            'freelancer' => $freelancer,
        ]);
    }

    public function active()
    {
        $user = auth()->user();

        $posts = Post::whereHas('proposals', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'in_progress')->get();

        return view('freelancer.active-jobs', [
            'posts' => $posts,
        ]);
    }

    public function rateClient(post $post)
    {
        return view('freelancer.rate-client', compact('post'));
    }

    public function submitRating(Request $request, post $post)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $clientUserId = $post->user_id;

        $client = Client::where('user_id', $clientUserId)->first();

        $client->update([
            'rating' => $request->rating,
        ]);

        return redirect()->route('freelancer.index')->with('success', 'Client rated successfully!');
    }

    public static function middleware()
    {
        return [
            function (Request $request, Closure $next) {
                $user = $request->user();
                if (!$user || !$user->freelancer) {
                    abort(403, 'access denied');
                }
                return $next($request);
            }
        ];
    }
}
