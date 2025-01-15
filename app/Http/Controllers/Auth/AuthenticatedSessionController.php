<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function store(Request $request)
    {
        // Tenta autenticar o usuário
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user(); // Pega o usuário autenticado

            // Redireciona de acordo com o tipo do usuário
            if ($user->idUserTipo == 2) { // Verifica se é médico
                return redirect()->route('medicos.agenda');
            }

            return redirect()->route('welcome'); // Redireciona para a página de boas-vindas caso não seja médico
        }

        // Se não autenticar, redireciona de volta com erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas são inválidas.',
        ]);
    }
}
