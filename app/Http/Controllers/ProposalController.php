<?php

namespace App\Http\Controllers;

use App\Ai\AiServices;
use App\Models\proposal;
use App\Http\Requests\StoreproposalRequest;
use App\Http\Requests\UpdateproposalRequest;
use App\Models\post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Middleware\EnsureUserIsFreelancer;


class ProposalController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = proposal::with('post')
            ->where('user_id', Auth()->id())
            ->latest()
            ->get();
        return view('freelancer.submit-proposals.index', [
            'proposals' => $proposals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('freelancer.proposal.create', [
            'post' => $post,
        ]);
    }

    public function generate(Post $post)
    {
        $jobDescription = $post->description;

        $description = new AiServices();
        $proposal = $description->generateResponse($jobDescription);

        return response()->json([
            'proposal' => $proposal,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProposalRequest $request, Post $post)
    {
        $userId = auth()->id();

        // Check if the user has already submitted a proposal for this post
        if ($post->proposals()->where('user_id', $userId)->exists()) {
            return redirect()->back()->with('error', 'You have already submitted a proposal for this job.');
        }

        $data = $request->validated();

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('proposals', 'public');
        }

        $data['user_id'] = $userId;

        $post->proposals()->create($data);

        return redirect()->route('freelancer.explore')->with('success', 'Proposal submitted successfully!');
    }

    public static function middleware()
    {
        return [
            'auth',
            new Middleware(EnsureUserIsFreelancer::class),
        ];
    }
}
