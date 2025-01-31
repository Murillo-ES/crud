@extends('layout')

@section('title', "Editar Produto")
   
@section('content')
  
<h1>Atualizar Produto</h1>

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

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="name"><strong>Nome:</strong></label>
                <input type="text" name="name" id="name" value="{{$product->name}}"><br>
                <label for="description"><strong>Descrição:</strong></label>
                <input type="text" name="description" id="description" value="{{$product->description}}"><br>
                <label for="price"><strong>Preço:</strong></label>
                <input type="number" name="price" id="price" step="0.01" min="0" value="{{$product->price}}"><br>
                <label for="stock"><strong>Quantidade Disponível:</strong></label>
                <input type="number" name="stock" id="stock" min="0" max="999" value="{{$product->stock}}"><br>
                <button class="btn waves-effect waves-light green" type="submit" name="action">Atualizar Produto
                    <i class="material-icons right">edit</i>
                </button>
            <form>
            <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn blue darken-4">
                Voltar<i class="material-icons right">arrow_back</i>
            </a>
        </div>
    </div>
</div>

@endsection