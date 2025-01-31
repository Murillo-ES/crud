@extends('layout')

@section('title', 'Produtos')
   
@section('content')
  
<div class="py-12">
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

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Produtos</h3>
            <a href="{{route('products.create')}}"><strong>Criar Produto</strong></a><br>
            <a href="{{route('cart.index')}}"><strong>Carrinho</strong></a><br>
            <a href="{{route('products.exportToCSV')}}"><strong>Exportar Produtos (CSV)</strong></a><br>
            <a href="{{route('products.exportToPDF')}}"><strong>Exportar Produtos (PDF)</strong></a>
            <br>

            <h5>Produtos disponíveis</h5>
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">
                            <a href="{{ route('products.index', ['sort' => 'price', 'order' => ($sort == 'price' && $order == 'asc') ? 'desc' : 'asc']) }}">
                                Preço {!! $sort == 'price' ? ($order == 'asc' ? '▲' : '▼') : '' !!}
                            </a>
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">
                            <a href="{{ route('products.index', ['sort' => 'stock', 'order' => ($sort == 'stock' && $order == 'asc') ? 'desc' : 'asc']) }}">
                                Quantidade Disponível {!! $sort == 'stock' ? ($order == 'asc' ? '▲' : '▼') : '' !!}
                            </a>
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Visualizar Produto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->stock > 0)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">{{ $product->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">{{ $product->description }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">{{ $product->stock }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">
                                    <a href="{{route('products.show', $product->id)}}">Visualizar Produto</a>
                                </td>              
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
            <h5>Produtos não disponíveis</h5>
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Preço</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">Visualizar Produto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->stock <= 0)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">{{ $product->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">{{ $product->description }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black" style="text-align: center">
                                    <a href="{{route('products.show', $product->id)}}">Visualizar Produto</a>
                                </td>              
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection