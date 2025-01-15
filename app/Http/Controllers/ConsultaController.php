<?php

// app/Http/Controllers/ConsultaController.php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\Farmaco;
use App\Models\ConsultaFarmaco;  // Adicione esta linha no início do arquivo

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function create()
    {
        // Buscar todas as especialidades
        $especialidades = Especialidade::all();
    
        $pacientes = [];  // Inicializar a variável de pacientes
        $paciente = null;  // Inicializar paciente como null
    
        // Verificar o tipo de usuário
        $user = auth()->user();
    
        if ($user->idUserTipo == 1) {
            // Buscar pacientes associados ao idUserTipo 3 e pegar o nome da tabela 'users'
            $pacientes = User::where('idUserTipo', 3)
                            ->join('tb004_pacientes', 'tb004_pacientes.idUser', '=', 'users.id')
                            ->select('tb004_pacientes.idPaciente as idPaciente', 'users.name as nome')
                            ->get();
        }

        // Se o usuário for do tipo 3 (paciente), buscar as informações do paciente
        if ($user->idUserTipo == 3) {
            // Buscar paciente associado ao usuário logado
            $paciente = Paciente::where('idUser', $user->id)->first();
        }
    
        // Passar as variáveis $especialidades, $pacientes e $paciente para a view
        return view('consultas.create', compact('especialidades', 'pacientes', 'user', 'paciente'));
    }

    // Método para buscar médicos por especialidade
    public function buscarMedicosPorEspecialidade($especialidadeId)
    {
        // Buscar médicos que pertencem à especialidade selecionada e carregar o usuário (nome do médico)
        $medicos = Medico::with('user')  // Carregar a relação 'user'
            ->where('idEspecialidade', $especialidadeId)
            ->get();
    
        return response()->json($medicos);
    }

    public function buscarPaciente($idPaciente)
    {
        $paciente = Paciente::find($idPaciente);
        if ($paciente) {
            return response()->json($paciente);
        }
        return response()->json(['error' => 'Paciente não encontrado'], 404);
    }

    public function store(Request $request)
    {
        // Recuperar o usuário autenticado
        $user = auth()->user();
    
        // Inicializar variável paciente
        $paciente = null;
    
        // Verificar se o tipo de usuário é paciente (idUserTipo == 3)
        if ($user->idUserTipo === 3) {
            // Buscar o paciente associado ao usuário logado
            $paciente = Paciente::where('idUser', $user->id)->first();
    
            // Se o paciente não existir, criar um novo paciente com valores padrão
            if (!$paciente) {
                $paciente = new Paciente();
                $paciente->idUser = $user->id;  // Atribui o ID do usuário logado
                $paciente->sexo = $request->sexo ?: 'Masculino'; // Se não houver valor no formulário, usa 'Masculino' como padrão
                $paciente->data_nascimento = $request->data_nascimento ?: '2000-01-01'; // Valor do formulário ou valor padrão
                $paciente->endereco = $request->endereco ?: 'Rua Exemplo, 123'; // Valor do formulário ou valor padrão
                $paciente->estado_civil = $request->estado_civil ?: 'Solteiro(a)';
                $paciente->plano_saude = $request->plano_saude ?: 'Nenhum';
                $paciente->save();  // Salva o novo paciente
            }
        } else {
            // Se não for paciente (por exemplo, admin), buscar o paciente baseado no idPaciente fornecido na requisição
            $paciente = Paciente::find($request->input('idPaciente'));

            // Se o paciente não for encontrado, retornar erro
            if (!$paciente) {
                return redirect()->route('consultas.create')->with('error', 'Paciente não encontrado.');
            }

            // Preencher automaticamente os campos sexo e data de nascimento para o administrador
            $request->merge([
                'sexo' => $paciente->sexo,
                'data_nascimento' => $paciente->data_nascimento,
            ]);
        }
    
        // Agora, validamos os dados da consulta, excluindo a validação do idPaciente, já que estamos lidando com isso manualmente
        $validated = $request->validate([
            'idMedico' => 'required|exists:tb001_medicos,idMedico',
            'data_consulta' => 'required|date',
        ]);
    
        // Atribui o idPaciente corretamente
        $validated['idPaciente'] = $paciente->idPaciente;

        // Obter o número da consulta
        // Verifica se o médico já tem consultas registradas para esse paciente
        $numeroConsulta = Consulta::where('idMedico', $validated['idMedico'])
            ->where('idPaciente', $validated['idPaciente'])
            ->count() + 1;

        $validated['numero_consulta'] = $numeroConsulta;
    
        // Criar a consulta com os dados validados
        Consulta::create($validated);
    
        // Redirecionar com mensagem de sucesso
        return redirect()->route('consultas.create')->with('msg', 'Consulta criada com sucesso!');
    }
    
    public function realizar(Consulta $consulta)
    {
        // Verifica se a consulta existe e está agendada
        if ($consulta->status != 'Agendada') {
            return redirect()->route('medicos.agenda')->with('error', 'Consulta não agendada ou já realizada.');
        }

        // Carrega todos os farmácios disponíveis
        $farmacos = Farmaco::all();

        return view('consultas.realizar', compact('consulta', 'farmacos'));
    }

    public function realizarConsulta(Request $request, Consulta $consulta)
    {
        // Validação
        $request->validate([
            'observacoes' => 'required|string',
            'farmacos' => 'array|nullable',
            'farmacos.*' => 'exists:tb006_farmacos,idFarmaco',
        ]);

        // Atualiza o status da consulta para 'Realizada'
        $consulta->update(['status' => 'Realizada', 'observacoes' => $request->observacoes]);

        // Associa os farmácios receitados
        if ($request->has('farmacos')) {
            foreach ($request->farmacos as $idFarmaco) {
                ConsultaFarmaco::create([
                    'idConsulta' => $consulta->idConsulta,
                    'idFarmaco' => $idFarmaco,
                ]);
            }
        }

        return redirect()->route('medicos.agenda')->with('success', 'Consulta realizada com sucesso!');
    }
}
