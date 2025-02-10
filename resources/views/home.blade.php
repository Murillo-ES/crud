@extends('layout')

@section('title', 'e-Commerce Project')

@section('content')

@if ($mensagem = Session::get('success'))
    <div class="card green">
        <div class="card-content white-text">
            <span class="card-title"><strong>Sucesso!</strong></span>
            <p>{{ $mensagem }}</p>
        </div>
    </div>
@endif

<div class="container center-align">
    <h4 class="blue-text text-darken-4">Bem-vindo!</h4>
    <p class="grey-text">Selecione uma opção:</p>

    <div class="row">
        <div class="col s12 m4">
            <a href="{{ route('products.index') }}" class="btn-large blue darken-4 waves-effect waves-light">
                <i class="material-icons left">list</i> Lista de Produtos
            </a>
        </div>

        <div class="col s12 m4">
            <a href="{{ route('users.index') }}" class="btn-large blue darken-4 waves-effect waves-light">
                <i class="material-icons left">group</i> Lista de Usuários
            </a>
        </div>

        <div class="col s12 m4">
            <a href="{{ route('products.create') }}" class="btn-large blue darken-4 waves-effect waves-light">
                <i class="material-icons left">add</i> Criar um Produto
            </a>
        </div>
    </div>
</div>

<br>

@guest
    <div class="container center-align">
        <div class="row">
            <div class="col s12 m4">
                <a href="{{ route('login') }}" class="btn-large blue darken-4 waves-effect waves-light">
                    <i class="material-icons left">login</i> Login
                </a>
            </div>

            <div class="col s12 m4">
                <a href="{{ route('register') }}" class="btn-large blue darken-4 waves-effect waves-light">
                    <i class="material-icons left">person_add</i> Criar uma Conta
                </a>
            </div>
        </div>
    </div>
@endguest

@auth
    <div class="container center-align">
        <div class="row">
            <div class="col s12 m4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-large blue darken-4 waves-effect waves-light">
                        <i class="material-icons left">logout</i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
@endauth

@endsection

@section('footer')

<footer class="page-footer blue darken-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Footer Content</h5>
          <p class="grey-text text-lighten-4">Text goes here.</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      © {{ date('Y') }} Copyright Text
      <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
      </div>
    </div>
</footer>

<style>
    html, body {
        height: 100%;
        display: flex;
        flex-direction: column;
        margin: 0;
    }

    main {
        flex: 1;
    }
</style>

@endsection