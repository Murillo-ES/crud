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

            @if ($mensagem = Session::get('caution'))
                <div class="card yellow">
                    <div class="card-content black-text">
                        <span class="card-title"><strong>Atenção!</strong></span>
                        <p>{{ $mensagem }}</p>
                    </div>
                </div>
            @endif

            @if ($mensagem = Session::get('danger'))
                <div class="card red">
                    <div class="card-content white-text">
                        <span class="card-title"><strong>Atenção!</strong></span>
                        <p>{{ $mensagem }}</p>
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="col s12 m6">
                  <div class="card blue lighten-1">
                    <div class="card-content grey-text text-lighten-4">
                        <span class="card-title"><strong>{{$product->name}}</strong></span>
                        <p><strong>Criador:</strong> <a href="{{route('user.details', $product->user->id)}}" class="white-text">{{$product->user->name}}</a></p>
                        <p>{{$product->description}}</p>
                        <p><strong>Preço: </strong>R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        <p><strong>Quantidade Disponível: </strong>{{$product->stock}}</p>
                        @if ($product->stock > 0)
                            <form action="{{route('cart.addProduct')}}" method="POST">
                                @csrf
                                <div class="input-field inline">
                                    <label for="quantity" class="grey-text text-lighten-4"><strong>Quantidade para comprar:</strong></label>
                                    <input type="number" name="quantity" class="grey-text text-lighten-4" id="quantity" min="1" max="{{$product->stock}}" size="3">
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">Adicionar ao carrinho
                                        <i class="material-icons right">add_shopping_cart</i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <p>Este produto não está disponível para compra no momento!</p>
                        @endif

                        @auth
                            @if ($userId == $product->user_id)
                                <br>
                                <div class="divider"></div>
                                <br>
                                <p><strong>Opções Adicionais</strong></p>
                                <br>
                                <div>
                                    @livewire('delete-button', [
                                        'productId' => $product->id
                                    ])
                                </div>
                                <br>
                                <form action="{{route('products.edit', $product->id)}}" method="GET">
                                    @csrf
                                    <button class="btn waves-effect waves-light yellow accent-3 black-text">Editar Produto
                                        <i class="material-icons right">edit</i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                        
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

<script>
    
</script>

@endsection