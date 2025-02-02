@extends('layout')

@section('title', 'Produtos')
   
@section('content')
  
<div class="col-s12 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            @if ($mensagem = Session::get('Sucesso!'))
                <div class="card green">
                    <div class="card-content white-text">
                        <span class="card-title">Sucesso!</span>
                        <p>{{ $mensagem }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            @if ($mensagem = Session::get('Falhou!'))
                <div class="card red">
                    <div class="card-content white-text">
                        <span class="card-title">Registro não encontrado!</span>
                        <p>{{ $mensagem }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-black">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4" style="text-align: center">Produtos</h3>
            <a href="{{route('products.exportToCSV')}}" class="waves-effect waves-light btn blue darken-4">
                Exportar Produtos (CSV)<i class="material-icons right">download</i>
            </a>
            <a href="{{route('products.exportToPDF')}}" class="waves-effect waves-light btn blue darken-4">
                Exportar Produtos (PDF)<i class="material-icons right">download</i>
            </a>

            <h5>Produtos disponíveis</h5>
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                            <a href="{{ route('products.index', ['sort' => 'price', 'order' => ($sort == 'price' && $order == 'asc') ? 'desc' : 'asc']) }}">
                                Preço {!! $sort == 'price' ? ($order == 'asc' ? '▲' : '▼') : '' !!}
                            </a>
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                            <a href="{{ route('products.index', ['sort' => 'stock', 'order' => ($sort == 'stock' && $order == 'asc') ? 'desc' : 'asc']) }}">
                                Quantidade Disponível {!! $sort == 'stock' ? ($order == 'asc' ? '▲' : '▼') : '' !!}
                            </a>
                        </th>
                        <th class="border border-bottom-gray-300 dark:border-gray-600 px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->stock > 0)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->stock }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn blue darken-4">
                                        <i class="material-icons right">info</i>Visualizar Produto</a>
                                </td>              
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
            <h5>Produtos não disponíveis</h5>
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Preço</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->stock <= 0)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn blue darken-4">
                                        <i class="material-icons right">info</i>Visualizar Produto</a>
                                </td>             
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>

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
      © 2014 Copyright Text
      <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
      </div>
    </div>
</footer>

@endsection