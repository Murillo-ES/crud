<div>
    <form wire:submit="create">
        <label for="name"><strong>Nome:</strong></label>
        <input type="text" name="name" wire:model.blur="name"><br>
        <div>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <label for="description"><strong>Descrição:</strong></label>
        <input type="text" name="description" wire:model="description"><br>

        <label for="price"><strong>Preço:</strong></label>
        <input type="number" name="price" wire:model.blur="price" step="0.01"><br>
        <div>
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <label for="stock"><strong>Quantidade Disponível:</strong></label>
        <input type="number" name="stock" wire:model.blur="stock">
        <div>
            @error('stock')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" wire:model="userId">
        
        <br>
        <button class="btn waves-effect waves-light green" type="submit">Criar Produto
            <i class="material-icons right">add_circle</i>
        </button>
    <form>
</div>
