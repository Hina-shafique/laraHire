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
        $commonRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:client,freelancer'],
        ];

        $clientRules = [
            'location' => ['required', 'string'],
            'language' => ['required', 'string'],
        ];

        $freelancerRules = [
            'description' => ['required', 'string'],
            'skills' => ['required', 'string'],
            'language' => ['required', 'string'],
            'location' => ['required', 'string'],
            'experience' => ['nullable', 'string'],
        ];

        // Merge the rules depending on user_type
        if ($request->user_type === 'client') {
            $rules = array_merge($commonRules, $clientRules);
        } else {
            $rules = array_merge($commonRules, $freelancerRules);
        }

        // Validate everything once
        $validated = $request->validate($rules);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Handle based on user type
        if ($validated['user_type'] === 'client') {
            $user->client()->create([
                'location' => $validated['location'],
                'language' => $validated['language'],
            ]);
        } else {
            $languageArray = array_map('trim', explode(',', $validated['language']));

            $user->freelancer()->create([
                'description' => $validated['description'],
                'skills' => $validated['skills'],
                'language' => $languageArray, // ✅ will store as JSON
                'location' => $validated['location'],
                'experience' => $validated['experience'],
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        return $validated['user_type'] === 'client'
            ? redirect()->route('client.index')
            : redirect()->route('freelancer.index');
    }

}
