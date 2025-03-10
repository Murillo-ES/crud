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

        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4" style="text-align: center">Seu Carrinho</h3>
            <a href="{{route('download.csv')}}" class="waves-effect waves-light btn blue darken-4">
                Exportar Carrinho (CSV)<i class="material-icons right">download</i>
            </a>
            <a href="{{route('download.pdf')}}" class="waves-effect waves-light btn blue darken-4">
                Exportar Carrinho (PDF)<i class="material-icons right">download</i>
            </a>
        </div>

        <br>

        </div>
            <table class="min-w-full centered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço Total</th>
                        <th>Remover Itens</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <a href="{{route('products.index', $item->id)}}"><strong>{{$item->name}}</strong></a><br>
                            </td>
                            <td>{{ $item->attributes->description }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                R$ {{ number_format($item->getPriceSum(), 2, ',', '.') }}
                            </td>
                            <td>
                                @livewire('remove-item', [
                                    'productId' => $item->id,
                                    'quantity' => $item->quantity
                                ], key($item->id))
                            </td>              
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            @if (count($items) != 0)
                <p style="text-align: center"><strong>Valor total da compra:</strong> R$ {{number_format(Cart::getTotal(), 2, ',', '.')}}</p>
            @endif

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