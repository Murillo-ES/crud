<div>
    <form wire:submit="edit">
        <input type="hidden" wire:model="productId" value="{{ $productId }}">

        <label for="name"><strong>Nome:</strong></label>
        <input type="text" name="name" wire:model.blur="name" value="{{ $name }}"><br>
        <div>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <label for="description"><strong>Descrição:</strong></label>
        <input type="text" name="description" wire:model.blur="description" value="{{ $description }}"><br>

        <label for="price"><strong>Preço:</strong></label>
        <input type="number" name="price" wire:model.blur="price" step="0.01" min="0" value="{{ $price }}"><br>
        <div>
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <label for="stock"><strong>Quantidade Disponível:</strong></label>
        <input type="number" name="stock" wire:model="stock" min="0" max="999" value="{{ $stock }}"><br>
        <div>
            @error('stock')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <button class="btn waves-effect waves-light green" type="submit">Atualizar Produto
            <i class="material-icons right">edit</i>
        </button>
    <form>
    <a href="{{route('products.show', $productId)}}" class="waves-effect waves-light btn blue darken-4">
        Voltar<i class="material-icons right">arrow_back</i>
    </a>
</div>