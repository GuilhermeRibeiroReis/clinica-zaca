@extends('layouts.main')

@section('title', 'Clinica Zaca - Criar Medico')

@section('content')

<h1>Criar Usuário Médico</h1>

<form action="/medicos" method="POST">
    @csrf
    <div class="container">
        <!-- Nome do médico -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nomeMedico" name="nomeMedico" placeholder="Nome do médico" required>
            <label for="nomeMedico">Nome do médico</label>
        </div>

        <!-- Email do médico -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            <label for="email">Email do médico</label>
        </div>

        <!-- Telefone do médico -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
            <label for="telefone">Telefone do médico</label>
        </div>

        <!-- Especialidade do médico -->
        <div class="form-floating mb-3">
            <select name="idEspecialidade" id="idEspecialidade" class="form-select" aria-label="Especialidade" required>
                @foreach ($especialidades as $especialidade)
                    <option value="{{ $especialidade->idEspecialidade }}">{{ $especialidade->descricao }}</option>
                @endforeach
            </select>
            <label for="idEspecialidade">Especialidade do médico</label>
        </div>

        <!-- Botão de envio -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Cadastrar Médico</button>
        </div>
    </div>
</form>

@endsection
