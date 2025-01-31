@extends('layout')

@section('title', 'Seu Carrinho')
   
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
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Seu Carrinho</h3>
            <a href="{{route('products.index')}}"><strong>Produtos</strong></a><br>
            <a href="{{route('cart.exportToCSV')}}"><strong>Exportar Carrinho (CSV)</strong></a>
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Quantidade</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Preço Total</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                <a href="{{route('products.index', $item->id)}}"><strong>{{$item->name}}</strong></a><br>
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $item->attributes->description }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $item->quantity }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">R$ {{ $item->getPriceSum() }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                <form action="{{route('cart.removeProduct')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <label for="quantity"><strong>Quantidade p/ remover:</strong></label>
                                    <input type="number" name="quantity" id="quantity" min="0" max="{{$item->quantity}}">
                                    <button>Remover Item</button>
                                </form>
                            </td>              
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <strong>Valor total da compra:</strong> {{Cart::getTotal()}}
            <form action="{{route('cart.clear')}}" method="POST">
                @csrf
                @foreach ($items as $item)
                    <input type="hidden" name="idArray[]" value="{{$item->id}}">
                @endforeach
                <button>Esvaziar Carrinho</button>
            </form>
            <form action="{{route('cart.checkout')}}" method="POST">
                @csrf
                @foreach ($items as $item)
                    <input type="hidden" name="idArray[]" value="{{$item->id}}">
                @endforeach
                <button>Finalizar Compra</button>
            </form>
        </div>
    </div>
</div>

@endsection