@extends('layouts.main')

@section('title', 'Clinica Zaca - Agenda Medico')

@section('content')
<div class="container">
    <h1>Agenda do Médico</h1>

    @if($consultas->isEmpty())
        <p>Não há consultas agendadas.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Data e Hora</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->paciente->user->name ?? 'Paciente não encontrado' }}</td> <!-- Nome do paciente -->
                    <td>{{ $consulta->data_consulta }}</td> <!-- Data e hora da consulta -->
                    <td>{{ $consulta->status ?? 'Agendada' }}</td> <!-- Status da consulta -->
                    <td>

                    <a href="{{ route('consulta.realizar', ['consulta' => $consulta->idConsulta]) }}" class="btn btn-primary">Realizar Consulta</a>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection