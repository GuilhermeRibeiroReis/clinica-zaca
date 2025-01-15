@extends('layouts.main')

@section('title', 'Clinica Zaca - Cadastramento')

@section('content')

@if(!auth()->check()) 
<h2>Cadastre-se aqui e seja nosso paciente</h2>
@endif

<x-guest-layout>

    <x-validation-errors class="mb-4" />

    <div class="flex justify-center items-center min-h-screen">
        <form method="POST" action="{{ route('register') }}" class="p-4 p-md-5 border rounded-3 bg-body-tertiary w-full max-w-lg">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                <label for="name">Nome</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="Email address">
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                <label for="password">Senha</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm Password">
                <label for="password_confirmation">Confirme a Senha</label>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <!--
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Ainda não tem cadastro ?') }}
                </a>
                -->
                <br>
                <button type="submit" class="w-100 btn btn-lg btn-primary ms-4">
                    {{ __('Cadastrar-se') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>

@endsection
