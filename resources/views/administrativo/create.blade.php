@extends('layouts.main')

@section('title', 'Clinica Zaca - Criar Administrativo')

@section('content')

    <div class="container">
        <h1>Criar Usuário Administrativo</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('administrativo.store') }}" method="POST" id="adminForm">
            @csrf

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" value="{{ old('telefone') }}">
            </div>

            <div class="form-group">
                <label for="salario">Salário</label>
                <input type="number" class="form-control" name="salario" value="{{ old('salario') }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Criar Administrativo</button>
        </form>
    </div>

    @endsection