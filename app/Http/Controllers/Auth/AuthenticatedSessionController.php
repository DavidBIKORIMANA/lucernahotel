<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $username = $profileData->name;

        $notification = array(
            'message' => 'User '.$username.' Login Successfully',
            'alert-type' => 'info'
        );

        $url = '';
        if($request->user()->hasRole('admin')){
            $url = '/admin/dashboard';
        } elseif($request->user()->hasRole('user')){
            $url = '/dashboard';
        }

        // Honor redirect param from booking flow (validate it's an internal path)
        $redirect = $request->input('redirect');
        if ($redirect && str_starts_with($redirect, url('/'))) {
            return redirect($redirect)->with($notification);
        }

        return redirect()->intended($url)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
