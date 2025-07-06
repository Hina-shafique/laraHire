<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $posts = Post::query()->latest()->paginate(5);
        return view('post.index', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
        // The validation 
        $data = $request->validated();
        // Attach the logged-in user ID
        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'You can only edit your own posts.');
        }

        return view('post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostRequest $request, post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function explore()
    {
        $posts = Post::where('status', 'open')->latest()->paginate(10);
        return view('freelancer.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function display(post $post)
    {
        return view('freelancer.posts.display', [
            'post' => $post,
        ]);
    }
}
