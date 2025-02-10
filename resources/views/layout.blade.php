<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @livewireStyles
    {{-- @vite('resources/css/app.css') --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

  <header>
    <ul id='dropdown1' class='dropdown-content blue-text'>
        <li><a href="{{ route('products.index') }}">Lista de Produtos</a></li>
        <li><a href="{{ route('products.create') }}">Criar Produto</a></li>
    </ul>

    <nav class="blue darken-4">
        <div class="nav-wrapper">
          <a href="{{route('home')}}" class="brand-logo center">e-Commerce Project</a>
          <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="{{route('home')}}">Home</a></li>
            <li>
                <a href="{{route('products.index')}}" class="dropdown-trigger" data-target="dropdown1">
                    Produtos<i class="material-icons right">expand_more</i>
                </a>
            </li>
            <li><a href="{{route('cart.index')}}">Carrinho</a></li>
            <li><a href="{{route('users.index')}}">Usuários</a></li>
            @guest
              <li><a href="{{route('register')}}">Criar uma Conta</a></li>
              <li><a href="{{route('login')}}"><i class="tiny material-icons right">login</i>Login</a></li>
            @endguest
            @auth
              <li>
                <a href="#" 
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="tiny material-icons right">logout</i> Logout
                </a>
            
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            @endauth
          </ul>
          <form action="{{route('products.search')}}" method="GET">
            <div class="input-field right">
              <input id="search" name="searchInput" type="search" required placeholder="Digite um nome!">
              <label class="label-icon right" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </form>
        </div>
      </nav>
  </header>

  <main>
    <div class="container">
        @yield('content')
    </div>
  </main>

  @yield('footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
      var elemDrop = document.querySelectorAll('.dropdown-trigger');
      var instanceDrop = M.Dropdown.init(elemDrop, {
        coverTrigger: false,
        constraiWidth: false
      });

      document.addEventListener("DOMContentLoaded", function () {
        var elems = document.querySelectorAll(".modal");
        M.Modal.init(elems);

        // Ensure modal is reinitialized after Livewire updates
        Livewire.hook("message.processed", () => {
            var elems = document.querySelectorAll(".modal");
            M.Modal.init(elems);
        });
      });
  </script>

  @livewireScripts
</body>
</html>