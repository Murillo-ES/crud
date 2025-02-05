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

            @if ($mensagem = Session::get('caution'))
                <div class="card yellow">
                    <div class="card-content text-black">
                        <span class="card-title"><strong>Atenção!</strong></span>
                        <p>{{ $mensagem }}</p>
                    </div>
                </div>
            @endif

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4" style="text-align: center">Seu Carrinho</h3>
            <a href="{{route('cart.exportToCSV')}}" class="waves-effect waves-light btn blue darken-4">
                Exportar Carrinho (CSV)<i class="material-icons right">download</i>
            </a>
            <a href="{{route('cart.exportToPDF')}}" class="waves-effect waves-light btn blue darken-4">
                Exportar Carrinho (PDF)<i class="material-icons right">download</i>
            </a>

            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 centered">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Quantidade</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Preço Total</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Remover Itens</th>
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
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                R$ {{ number_format($item->getPriceSum(), 2, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                @livewire('remove-item', [
                                    'productId' => $item->id,
                                    'quantity' => $item->quantity
                                ], key($item->id))
                            </td>              
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="text-align: center"><strong>Valor total da compra:</strong> R$ {{number_format(Cart::getTotal(), 2, ',', '.')}}</p>
            <form action="{{route('cart.clear')}}" method="POST">
                @csrf
                @foreach ($items as $item)
                    <input type="hidden" name="idArray[]" value="{{$item->id}}">
                @endforeach
                <button class="btn waves-effect waves-light red accent-4">Esvaziar Carrinho
                    <i class="material-icons right">remove_shopping_cart</i>
                </button>
            </form>
            <br>
            <form action="{{route('cart.checkout')}}" method="POST">
                @csrf
                @foreach ($items as $item)
                    <input type="hidden" name="idArray[]" value="{{$item->id}}">
                @endforeach
                <button class="btn waves-effect waves-light green accent-3">Finalizar Compra
                    <i class="material-icons right">shopping_cart_checkout</i>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection