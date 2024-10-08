<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
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
    protected function joinCode(): string
    {
        return Setting::first() ? Setting::first()->join_code : '';
    }

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
            'full_name' => ['nullable', 'string', 'max:255'],
            'join_code' => ['sometimes', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->join_code && !Hash::check($request->join_code, $this->joinCode()))
            return back()->withErrors([
                'join_code' => 'The provided registration code is incorrect.',
            ])->onlyInput('join_code');

        $user = User::create([
            'role' => $request->join_code ? 'admin' : 'user',
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (in_array($user->role, config('vars.roles')))
            $redirect = route(config("vars.admin_route_prefix") . 'dashboard');
        else
            $redirect = route('home');
        return redirect($redirect);
    }
}
