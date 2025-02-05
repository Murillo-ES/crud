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

        {{-- If users are authenticated and creating products, this would be a hidden input, with the user ID as value. --}}
        <label for="user"><strong>Usuário</strong></label>
        <select class="browser-default" wire:model="userId">
            <option value="" disabled selected>Selecione um usuário:</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <div>
            @error('user')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <br>
        <button class="btn waves-effect waves-light green" type="submit">Criar Produto
            <i class="material-icons right">add_circle</i>
        </button>
    <form>
</div>
