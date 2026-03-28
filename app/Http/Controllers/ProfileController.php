<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $sessions = \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) use ($request) {
                return (object) [
                    'agent' => $session->user_agent,
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === $request->session()->getId(),
                    // En las sesiones de base de datos de Laravel, last_activity suele ser un entero (timestamp).
                    'last_active' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                ];
            });

        return view('profile.edit', [
            'user' => $request->user(),
            'sessions' => $sessions,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Delete other browser sessions.
     */
    public function destroyOtherSessions(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        \Illuminate\Support\Facades\Auth::logoutOtherDevices($request->input('password'));

        return Redirect::route('profile.edit')->with('status', 'other-sessions-deleted');
    }
}
