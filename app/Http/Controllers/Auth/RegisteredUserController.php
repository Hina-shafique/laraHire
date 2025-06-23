<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:client,freelancer'],
        ]);
        dd($request->all());


        // Step 2: Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Step 3: Based on user_type, create client or freelancer record
       if ($request->user_type === 'client') {
        $request->validate([
            'location' => ['required', 'string'],
            'language' => ['required', 'string'],
        ]);

        $user->client()->create([
            'location' => $request->location,
            'language' => $request->language,
        ]);
    } else if ($request->user_type === 'freelancer') {
        $request->validate([
            'description' => ['required', 'string'],
            'skills' => ['required', 'string'],
            'language' => ['required', 'string'],
            'location' => ['required', 'string'],
            'experience' => ['nullable', 'string'],
        ]);

        $user->freelancer()->create([
            'description' => $request->description,
            'skills' => $request->skills,
            'language' => $request->language,
            'location' => $request->location,
            'experience' => $request->experience,
        ]);
    }
    

        // Step 4: Fire registered event and login
        event(new Registered($user));

        Auth::login($user);
        // Step 5: Redirect to respective dashboard
        if ($request->user_type === 'client') {
            return redirect()->route('client.index');
        }

        if ($request->user_type === 'freelancer') {
            return redirect()->route('freelancer.index');
        }

        // Fallback
        return redirect('/');
    }
}
