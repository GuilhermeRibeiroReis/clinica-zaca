<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Administrativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministrativoController extends Controller
{
    /**
     * Exibe o formulário para criar um novo administrativo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administrativo.create');
    }

    /**
     * Salva um novo administrativo e seu respectivo usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirmação de senha
            'telefone' => 'nullable|string|max:15',
            'salario' => 'required|numeric',
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Definindo o tipo de usuário como 1 (administrativo)
        $user->idUserTipo = 1;
        $user->save();

        // Criação do administrativo (associando o usuário criado)
        Administrativo::create([
            'idAdministrativo' => $user->id, // Relacionando ao usuário
            'telefone' => $request->telefone,
            'salario' => $request->salario,
        ]);

        // Redirecionamento com sucesso
        return redirect()->route('administrativo.create')->with('success', 'Usuário administrativo criado com sucesso!');
    }
}
