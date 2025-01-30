@extends('layout')

@section('title', 'Novo Produto')
   
@section('content')
  
<h1>Criação de Produto</h1>

<div class="py-12">
    <a href="{{route('products.index')}}"><strong>Produtos</strong></a>

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

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <label for="name"><strong>Nome:</strong></label>
                <input type="text" name="name" id="name"><br>
                <label for="description"><strong>Descrição:</strong></label>
                <input type="text" name="description" id="description"><br>
                <label for="price"><strong>Preço:</strong></label>
                <input type="number" name="price" id="price" step="0.01" min="0"><br>
                <label for="stock"><strong>Quantidade Disponível:</strong></label>
                <input type="number" name="stock" id="stock" min="1" max="999" value="1">
                <input type="submit" value="Registrar Produto">
            <form>
        </div>
    </div>
</div>

@endsection