<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RedirectUserAfterLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Verifique o tipo de usuário e redirecione conforme necessário
        $user = $event->user;

        if ($user->idUserTipo == 2) {
            // Se o usuário for médico, redireciona para a agenda
            return redirect()->route('medicos.agenda');
        }

        // Se for outro tipo de usuário, redireciona para a página principal
        return redirect()->route('welcome');
    }
}
