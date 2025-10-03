<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Marca la dirección de correo del usuario autenticado como verificada.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Obtener el usuario autenticado de forma explícita
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Si ya está verificado, redirigir al dashboard con query ?verified=1
        if ($user && $user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard') . '?verified=1');
        }

        // Si se marca como verificado, lanzar el evento Verified
        if ($user && $user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(route('dashboard') . '?verified=1');
    }
}
