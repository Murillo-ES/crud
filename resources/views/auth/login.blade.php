@extends('layout')

@section('title', 'Login')

@section('content')

<div class="container">
    <h4 class="blue-text text-darken-4 center-align">Login</h4>

    <!-- Session Status -->
    @if (session('status'))
        <div class="card green">
            <div class="card-content white-text">
                <span class="card-title"><strong>Sucesso!</strong></span>
                <p>{{ session('status') }}</p>
            </div>
        </div>
    @endif

    @if ($mensagem = Session::get('caution'))
        <div class="card yellow">
            <div class="card-content black-text">
                <span class="card-title"><strong>Acesso Negado!</strong></span>
                <p>{{ $mensagem }}</p>
            </div>
        </div>
    @endif

    <div class="row">
        <form method="POST" action="{{ route('login') }}" class="col s12 m8">
            @csrf

            <!-- Email -->
            <div class="input-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="validate">
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

            <!-- Remember Me -->
            <p>
                <label>
                    <input type="checkbox" name="remember" />
                    <span>Manter login</span>
                </label>
            </p>

            <!-- Login Button & Forgot Password -->
            <div class="row">
                <div class="col s12 m6">
                    <button type="submit" class="btn-large blue darken-4 waves-effect waves-light">
                        <i class="material-icons left">login</i> Entrar
                    </button>
                </div>

                <div class="col s12 m6 right-align">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="blue-text text-darken-4">Esqueceu sua senha?</a>
                    @endif
                    <br>
                    <a href="{{ route('register') }}" class="blue-text text-darken-4">Não tenho uma conta ainda.</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
