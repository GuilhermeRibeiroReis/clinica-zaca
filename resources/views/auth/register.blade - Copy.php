@extends('layouts.main')

@section('title', 'Clinica Zaca - Cadastramento')

@section('content')

@if(!auth()->check()) 
    <h2>Cadastre-se aqui e seja nosso paciente</h2>
@endif

<x-guest-layout>

    <x-validation-errors class="mb-4" />

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <form method="POST" action="{{ route('register') }}" class="p-4 p-md-5 border rounded-3 bg-light w-100 w-md-50">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                <label for="name">Nome</label>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Email address">
                <label for="email">Email</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Password">
                <label for="password">Senha</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required placeholder="Confirm Password">
                <label for="password_confirmation">Confirme a Senha</label>
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="d-flex align-items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-decoration-none">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-decoration-none">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Cadastrar-se') }}
                </button>
            </div>
        </form>
    </div>

</x-guest-layout>

@endsection
