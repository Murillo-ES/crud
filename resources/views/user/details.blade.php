@extends('layout')

@section('title', 'Perfil do Usuário')
   
@section('content')
  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card blue lighten-1">
                        <div class="card-content grey-text text-lighten-4">
                            <span class="card-title"><strong>{{ $user->name }}</strong></span>
                            <p><strong>Cadastrado aos:</strong> {{$user->created_at->format('d/m/Y')}}</p>
                            <p><strong>Quantidade de Produtos:</strong> {{count($products)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h5>Produtos Cadastrados</h5>
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Descrição</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Preço</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Quantidade Disponível</a>
                        </th>
                        <th class="border border-bottom-gray-300 dark:border-gray-600 px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->stock }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn-small blue darken-4">
                                    Visualizar Produto</a>
                            </td>              
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    
</script>

@endsection