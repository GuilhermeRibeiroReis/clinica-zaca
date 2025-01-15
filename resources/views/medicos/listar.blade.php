@extends('layouts.main')

@section('title', 'Lista de Médicos')

@section('content')

<h1>Lista de Médicos</h1>

@if(session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif

@foreach($medicosPorEspecialidade as $especialidade => $medicos)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3>{{ $especialidade }}</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome do Médico</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicos as $medico)
                    <tr>
                        <td>{{ $medico->user->name }}</td> <!-- Acessando o nome do médico -->
                        <td>{{ $medico->user->email }}</td> <!-- Acessando o email do médico -->
                        <td>{{ $medico->telefone }}</td> <!-- Exibindo o telefone do médico -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach

@endsection
