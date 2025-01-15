<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterAdminController extends Controller
{
    // Exibe o formulário de registro
    public function showForm()
    {
        return view('auth.registerAdmin');
    }

    // Processa o formulário de registro
    public function register(Request $request)
    {
        // Validação dos campos
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
    
        // Criação do usuário com o tipo admin
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'tipo' => 1, // Atribuindo o tipo como 'admin'
        ]);
    
        // Redireciona para a página de boas-vindas e define a mensagem na sessão
        session()->flash('msg', 'Administrador cadastrado com sucesso!');
        return redirect()->route('welcome');
    }
    
}
