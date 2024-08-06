<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class FailedLoginResponse implements Responsable
{
    public function toResponse($request)
    {
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Estas credenciales no coinciden con nuestros registros.'])
            ->with('error', 'Credenciales incorrectas, por favor inténtalo de nuevo.');
    }
}
