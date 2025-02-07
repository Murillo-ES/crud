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

            <livewire:product-list />
            
        </div>
    </div>
</div>
<br>

@endsection