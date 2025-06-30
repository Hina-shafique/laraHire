<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use App\Models\User;
use App\Models\post;
use Illuminate\Support\Facades\Auth;

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
}
