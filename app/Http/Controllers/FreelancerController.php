<?php

namespace App\Http\Controllers;

use App\Models\freelancer;
use App\Http\Requests\StorefreelancerRequest;
use App\Http\Requests\UpdatefreelancerRequest;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $freelancer = $user->freelancer;
        return view('freelancer.index',[
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
        //
    }
}
