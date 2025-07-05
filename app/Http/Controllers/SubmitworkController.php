<?php

namespace App\Http\Controllers;

use App\Models\submitwork;
use App\Http\Requests\StoresubmitworkRequest;
use App\Http\Requests\UpdatesubmitworkRequest;
use App\Models\post;

class SubmitworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('freelancer.submit-work.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresubmitworkRequest $request, Post $post)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['post_id'] = $post->id;

        submitwork::create($data);

        return redirect()->route('freelancer.index')->with('success', 'submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(submitwork $submitwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(submitwork $submitwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesubmitworkRequest $request, submitwork $submitwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(submitwork $submitwork)
    {
        //
    }
}
