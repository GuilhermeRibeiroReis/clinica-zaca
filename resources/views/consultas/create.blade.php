@extends('layouts.main')

@section('title', 'Criar Consulta')

@section('content')
    <div class="container">
        <h1>Criar Nova Consulta</h1>

            <form id="form-consulta" method="POST" action="{{ route('consultas.store') }}">
            
            @csrf

            <!-- Campo para selecionar paciente (apenas se o tipo de usuário for admin) -->
            @if ($user->idUserTipo == 1)
            <div class="form-group">
                <label for="idPaciente">Paciente</label>
                <select name="idPaciente" id="idPaciente" class="form-control">
                    <option value="">Selecione um paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->idPaciente }}" 
                            {{ old('idPaciente') == $paciente->idPaciente ? 'selected' : '' }}>
                            {{ $paciente->nome }}
                            {{ $paciente->idPaciente }}
                        </option>
                    @endforeach
                </select>
                @error('idPaciente')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            @endif          

            <!-- Campo para data de nascimento -->
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento', $paciente->data_nascimento ?? '') }}" 
                    {{ $user->idUserTipo == 3 && $paciente ? 'readonly' : '' }} required>
                @error('data_nascimento')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para endereço -->
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <textarea class="form-control" id="endereco" name="endereco" required>{{ old('endereco', $paciente->endereco ?? '') }}</textarea>
                @error('endereco')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para estado civil -->
            <div class="form-group">
                <label for="estado_civil">Estado Civil</label>
                <select name="estado_civil" id="estado_civil" class="form-control">
                    <option value="">Selecione o estado civil</option>
                    <option value="Solteiro(a)" {{ old('estado_civil', $paciente->estado_civil ?? '') == 'Solteiro(a)' ? 'selected' : '' }}>Solteiro(a)</option>
                    <option value="Casado(a)" {{ old('estado_civil', $paciente->estado_civil ?? '') == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                    <option value="Divorciado(a)" {{ old('estado_civil', $paciente->estado_civil ?? '') == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                    <option value="Viúvo(a)" {{ old('estado_civil', $paciente->estado_civil ?? '') == 'Viúvo(a)' ? 'selected' : '' }}>Viúvo(a)</option>
                    <option value="Outro" {{ old('estado_civil', $paciente->estado_civil ?? '') == 'Outro' ? 'selected' : '' }}>Outro</option>
                </select>
                @error('estado_civil')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para plano de saúde -->
            <div class="form-group">
                <label for="plano_saude">Plano de Saúde</label>
                <input type="text" class="form-control" id="plano_saude" name="plano_saude" value="{{ old('plano_saude', $paciente->plano_saude ?? '') }}">
                @error('plano_saude')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para sexo -->
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" {{ $user->idUserTipo == 3 && $paciente ? 'disabled' : '' }}>
                    <option value="">Selecione o sexo</option>
                    <option value="Masculino" {{ old('sexo', $paciente->sexo ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ old('sexo', $paciente->sexo ?? '') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="Outro" {{ old('sexo', $paciente->sexo ?? '') == 'Outro' ? 'selected' : '' }}>Outro</option>
                </select>
                @error('sexo')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para selecionar a especialidade -->
            <div class="form-group">
                <label for="especialidade">Especialidade</label>
                <select name="especialidade" id="especialidade" class="form-control" required>
                    <option value="">Selecione uma especialidade</option>
                    @foreach($especialidades as $especialidade)
                        <option value="{{ $especialidade->idEspecialidade }}" {{ old('especialidade') == $especialidade->idEspecialidade ? 'selected' : '' }}>
                            {{ $especialidade->descricao }}  <!-- Aqui você deve garantir que 'nome' é o campo correto na tabela de especialidades -->
                        </option>
                    @endforeach
                </select>
                @error('especialidade')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para selecionar o médico -->
            <div class="form-group">
                <label for="medico">Médico</label>
                <select name="idMedico" id="medico" class="form-control" required>
                    <option value="">Selecione um médico</option>
                </select>
                @error('idMedico')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para a data da consulta -->
            <div class="form-group">
                <label for="data_consulta">Data da Consulta</label>
                <input type="datetime-local" class="form-control" id="data_consulta" name="data_consulta" value="{{ old('data_consulta') }}" required>
                @error('data_consulta')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botão para enviar o formulário -->
            <button type="submit" class="btn btn-primary mt-3">Criar Consulta</button>
        </form>
    </div>

    <!-- Scripts para carregar médicos com base na especialidade -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $('#especialidade').on('change', function() {
        var especialidadeId = $(this).val();

        if (especialidadeId) {
            $.ajax({
                url: '/medicos/por-especialidade/' + especialidadeId,
                method: 'GET',
                success: function(data) {
                    var medicoSelect = $('#medico');
                    medicoSelect.empty();
                    medicoSelect.append('<option value="">Selecione um médico</option>');

                    $.each(data, function(index, medico) {
                        medicoSelect.append('<option value="' + medico.idMedico + '">' + medico.user.name + '</option>');
                    });
                }
            });
        } else {
            $('#medico').empty().append('<option value="">Selecione um médico</option>');
        }
    });

    $(document).ready(function() {
        // Evento que é disparado quando o paciente é selecionado
        $('#idPaciente').change(function() {
            var idPaciente = $(this).val();

            if (idPaciente) {
                // Fazer a requisição AJAX para buscar os dados do paciente
                $.ajax({
                    url: '/consulta/buscar-paciente/' + idPaciente, // Adapte a URL conforme a rota
                    method: 'GET',
                    success: function(response) {
                        if (response) {
                            // Preencher automaticamente os campos de sexo e data de nascimento
                            $('#sexo').val(response.sexo);
                            $('#data_nascimento').val(response.data_nascimento);
                            $('#endereco').val(response.endereco);
                            $('#estado_civil').val(response.estado_civil);
                            $('#plano_saude').val(response.plano_saude);
                        }
                    },
                    error: function() {
                        alert("Paciente não encontrado.");
                    }
                });
            }
        });
    });
    </script>   
@endsection
