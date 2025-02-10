@extends('layout')

@section('title', 'Novo Produto')
   
@section('content')
  
<h1>Criação de Produto</h1>

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

            @livewire('create-product', ['userId' => $userId])
            <br>
            <a href="{{route('products.index')}}" class="waves-effect waves-light btn blue darken-4">
                Voltar<i class="material-icons right">arrow_back</i>
            </a>
        </div>
    </div>
</div>

@endsection