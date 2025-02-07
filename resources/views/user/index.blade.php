@extends('layout')

@section('title', 'Usuários')
   
@section('content')
  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-black">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4" style="text-align: center">Usuários</h3>

                <div>
                    <a href="{{ route('users.exportToCSV') }}" class="waves-effect waves-light btn blue darken-4">
                        Exportar Usuários (CSV)<i class="material-icons right">download</i>
                    </a>
                    <a href="{{ route('users.exportToPDF') }}" class="waves-effect waves-light btn blue darken-4">
                        Exportar Usuários (PDF)<i class="material-icons right">download</i>
                    </a>
                </div>

                <br>

                <livewire:user-list />
                
            </div>
        </div>
    </div>
</div>

<script>
    
</script>

@endsection