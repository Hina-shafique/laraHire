<?php

namespace App\Http\Controllers;

use App\Models\freelancer;
use App\Models\post;
use App\Models\Client;
use App\Http\Requests\StorefreelancerRequest;
use App\Http\Requests\UpdatefreelancerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $freelancer = $user->freelancer;
        return view('freelancer.index', [
            'user' => $user,
            'freelancer' => $freelancer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefreelancerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(freelancer $freelancer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(freelancer $freelancer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefreelancerRequest $request, freelancer $freelancer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(freelancer $freelancer)
    {
        //
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
}
