@extends('layout')

@section('title', 'Usuários')
   
@section('content')
  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-black">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4" style="text-align: center">Usuários</h3>

                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome de Usuário</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Data de Cadastro</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Quantidade de Produtos</th>
                            <th class="border border-bottom-gray-300 dark:border-gray-600 px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $user->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{$user->created_at->format('d/m/Y')}}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{count($user->products)}}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    <a href="{{route('user.details', $user->id)}}" class="waves-effect waves-light btn-small blue darken-4">
                                        Visualizar Usuário<i class="material-icons right">info</i></a>
                                </td>              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<script>
    
</script>

@endsection