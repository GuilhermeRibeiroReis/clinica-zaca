<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;

class ConsultaForm extends Component
{
    public $idEspecialidade;
    public $idMedico;
    public $idPaciente;
    public $numero_consulta;
    public $data_consulta;

    public function render()
    {
        // Buscando as especialidades, médicos e pacientes
        $especialidades = Especialidade::all();
        $medicos = Medico::where('idEspecialidade', $this->idEspecialidade)->get(); // Filtra médicos pela especialidade
        $pacientes = Paciente::all();

        return view('livewire.consulta-form', compact('especialidades', 'medicos', 'pacientes'));
    }

    public function saveConsulta()
    {
        // Lógica para salvar a consulta no banco de dados
        // Isso pode incluir a validação e o salvamento da consulta no banco
    }
}
