<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;


class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            Log::info('User already verified:', ['user_id' => $request->user()->id]);
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        try {
            $request->user()->sendEmailVerificationNotification();
            Log::info('Verification email sent:', ['user_id' => $request->user()->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send verification email:', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
            ]);
        }

        return back()->with('status', 'verification-link-sent');
    }
}
