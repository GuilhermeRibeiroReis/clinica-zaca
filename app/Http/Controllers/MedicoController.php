<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidade;
use App\Models\User; // Importando o modelo User

class MedicoController extends Controller
{
    // Exibe todos os médicos
    public function index()
    {
        $medicos = Medico::all();

        return view('welcome', ['medicos' => $medicos]);
    }

    // Exibe o formulário para criar um novo médico
    public function criar()
    {
        $especialidades = Especialidade::all();
        
        // Passando as especialidades para a view
        return view('medicos.criar', compact('especialidades'));
    }

    // Salva o novo médico, associando-o ao usuário e à especialidade
    public function store(Request $request)
    {
        // Validando os dados recebidos
        $request->validate([
            'nomeMedico' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Verifica se o e-mail já existe na tabela users
            'telefone' => 'nullable|string|max:50',
            'idEspecialidade' => 'required|exists:tb002_especialidades,idEspecialidade', // Verifica se a especialidade existe
        ]);


        // Log para verificar os dados antes de criar o usuário
        \Log::debug('Dados do Médico:', $request->all());


        // Criar o usuário (se ainda não existir)
        $user = User::create([
            'name' => $request->nomeMedico,  // O nome do médico será o nome do usuário
            'email' => $request->email,
            'password' => bcrypt('password'),  // Criação de uma senha padrão (você pode personalizar isso depois)
            'idUserTipo' => 2,  // Supondo que "2" seja o ID do tipo "médico" na tabela tb008_user_tipo
        ]);

        // Criar o médico e associá-lo ao usuário e à especialidade
        $medico = new Medico;
        //$medico->nomeMedico = $request->nomeMedico;
        //$medico->email = $request->email;
        $medico->telefone = $request->telefone;
        $medico->idEspecialidade = $request->idEspecialidade;
        $medico->idUser = $user->id;  // Associando o médico ao usuário criado
        $medico->save();

        return redirect('/')->with('msg', 'Médico teste cadastrado com sucesso!');
    }

    // Lista todos os médicos
    public function listar()
    {
            // Eager load a relação 'user' para acessar o nome do médico
        $medicos = Medico::with('user')->get();
        // Carregar médicos junto com suas especialidades e usuários
        $medicos = Medico::with(['especialidade', 'user'])->get();
    
        // Agrupar médicos por especialidade
        $medicosPorEspecialidade = $medicos->groupBy(function($medico) {
            return $medico->especialidade ? $medico->especialidade->descricao : 'Sem Especialidade'; 
        });
    
        return view('medicos.listar', ['medicosPorEspecialidade' => $medicosPorEspecialidade]);
    }

    public function agenda()
    {
        // Recupera o idMedico do médico autenticado
        $medico = Medico::where('idUser', Auth::id())->first();
    
        // Se o médico não for encontrado, redireciona ou exibe erro
        if (!$medico) {
            return redirect()->route('welcome')->with('error', 'Médico não encontrado.');
        }
    
        // Busca as consultas agendadas para o médico
        $consultas = Consulta::where('idMedico', $medico->idMedico)  // Agora com o idMedico correto
                             ->orderBy('data_consulta', 'asc')  // Ordena pela data da consulta
                             ->with('paciente')  // Carrega o paciente relacionado para exibir o nome
                             ->get();
    
        // Passa as consultas para a view
        return view('medicos.agenda', compact('consultas'));
    }
}
