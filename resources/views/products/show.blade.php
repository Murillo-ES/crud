@extends('layout')

@section('title', 'Visualizar Produto')
   
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
            
            <a href="{{route('products.index')}}"><strong>Produtos</strong></a><br>
            <a href="{{route('cart.index')}}"><strong>Carrinho</strong></a><br>
            <a href="{{route('products.edit', $product->id)}}">Editar Produto</a>

            <h4><strong>Nome:</strong> {{$product->name}}</h4><br>
            <p><strong>Descrição:</strong> {{$product->description}}</p><br>
            <p><strong>Preço:</strong> R$ {{$product->price}}</p><br>
            <p><strong>Quantidade Disponível:</strong> {{$product->stock}}</p><br>
            @if ($product->stock > 0)
                <form action="{{route('cart.addProduct')}}" method="POST">
                    @csrf
                    <label for="quantity"><strong>Quantidade:</strong></label>
                    <input type="number" name="quantity" id="quantity" min="1" max="{{$product->stock}}">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button>Adicionar ao carrinho</button>
                </form>
            @else
                <p>Este produto não está disponível para compra no momento!</p>
            @endif
            <br>
            <form action="{{route('products.destroy', $product->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-floating waves-effect waves-light green">Excluir Produto</button>
            </form>
        </div>
    </div>
</div>

@endsection