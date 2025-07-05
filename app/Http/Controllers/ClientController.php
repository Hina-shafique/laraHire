<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use App\Models\submitwork;
use App\Models\User;
use App\Models\Freelancer;
use App\Models\proposal;
use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreelancerHired;
use App\Notifications\freelancerHireNotification;
use Illuminate\Http\Request;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // get the related client model
        $client = $user->client;
        $posts = post::class;
        return view('client.index', [
            'client' => $client,
            'user' => $user,
            'posts' => $posts,
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
    public function store(StoreclientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclientRequest $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        //
    }

    public function viewProposal($id)
    {
        $post = Post::with('proposals.freelancer.user')->findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.proposals.index', [
            'post' => $post,
        ]);
    }

    public function hire(Proposal $proposal)
    {
        $post = $proposal->post;
        $days = (int) filter_var($post->timeline, FILTER_SANITIZE_NUMBER_INT);

        $post->update([
            'status' => 'in_progress',
            'deadline' => now()->addDays($days),
        ]);

        $proposal->user->notify(new freelancerHireNotification($proposal));

        Mail::to($proposal->user->email)->send(new FreelancerHired($proposal));

        return back()->with('success', 'Freelancer hired and email sent.');
    }

    public function reviewSubmission(post $post)
    {
        $freelancerId = $post->proposals()
            ->first()?->user_id;

        if (!$freelancerId) {
            return back()->with('error', 'No freelancer has been hired for this job.');
        }

        $submission = submitwork::where('post_id', $post->id)
            ->where('user_id', $freelancerId)
            ->first();

        if (!$submission) {
            return back()->with('error', 'No submission received yet.');
        }

        return view('client.submit-work', compact('post', 'submission'));
    }

    public function submitConfirm(post $post)
    {
        $post->update(['status' => 'completed']);

        return redirect()->route('rateFreelancer', $post->id)->with('success', 'job mark as completed');
    }

    public function rateFreelancer(post $post)
    {
        return view('client.give-rating', compact('post'));
    }

    public function submitRating(Request $request, post $post)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $freelancerId = $post->proposals()->first()?->user_id;

        Freelancer::where('user_id', $freelancerId)
            ->update(['rating' => $request->rating]);

        return redirect()->route('client.index')->with('success', 'Job completed and rating submitted.');
    }

}
