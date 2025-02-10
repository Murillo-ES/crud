@extends('layout')

@section('title', 'Registro')

@section('content')

<div class="container">
    <h4 class="blue-text text-darken-4 center-align">Criar Conta</h4>

    <div class="row">
        <form method="POST" action="{{ route('register') }}" class="col s12 m8">
            @csrf

            <!-- Name -->
            <div class="input-field">
                <label for="name">Nome</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="validate">
                @error('name')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="input-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="validate">
                @error('email')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-field">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" required class="validate">
                @error('password')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="input-field">
                <label for="password_confirmation">Confirmar Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="validate">
                @error('password_confirmation')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register Button & Login Link -->
            <div class="row">
                <div class="col s12 m6">
                    <button type="submit" class="btn-large blue darken-4 waves-effect waves-light">
                        <i class="material-icons left">person_add</i> Registrar
                    </button>
                </div>

                <div class="col s12 m6 right-align">
                    <a href="{{ route('login') }}" class="blue-text text-darken-4">Já tem uma conta?</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
