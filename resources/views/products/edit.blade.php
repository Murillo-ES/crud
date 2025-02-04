@extends('layout')

@section('title', "Editar Produto")
   
@section('content')
  
<h1>Atualizar Produto</h1>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
            @livewire('edit-product', [
                'productId' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock
            ])
        </div>
    </div>
</div>

@endsection