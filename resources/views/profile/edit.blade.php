@extends('layout')

@section('title', 'Seu Perfil')

@section('content')

<div class="container">
    <h4 class="blue-text text-darken-4 center-align">Seu Perfil</h4>

    @if ($mensagem = Session::get('success'))
        <div class="card green">
            <div class="card-content white-text">
                <span class="card-title"><strong>Acesso Negado!</strong></span>
                <p>{{ $mensagem }}</p>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @livewire('new-token', ['user' => $user])

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection