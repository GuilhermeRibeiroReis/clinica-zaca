@extends('layouts.main')

@section('title', 'Clinica Zaca - Log In')

@section('content')

<div class="tituloPagina">
    <br>Entre com suas credenciais<br>
</div>

<div class="flex justify-center items-center min-h-screen">
    <form method="POST" action="{{ route('login') }}" class="p-4 p-md-5 border rounded-3 bg-body-tertiary w-full max-w-lg">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
            <label for="email">Email</label>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
            <label for="password">Senha</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember" value="remember_me"> Lembrar-me
            </label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>

        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        </div>
    </form>
</div>

@endsection
