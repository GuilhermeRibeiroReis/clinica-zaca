@extends('layouts.main')

@section('title', 'Clinica Zaca - Ficha do Paciente')

@section('content')

<h1>Ficha do Paciente</h1>
    @if($idPaciente)
        <p>ID do Paciente: {{ $idPaciente }}</p>
    @else
        <p>Nenhum paciente foi selecionado.</p>
    @endif

@endsection