<div>
    <div class="row">
        <button
            wire:click="orderProducts('latest')"
            type="button"
            class="btn-small waves-effect waves-light blue darken-4"
            style="margin-bottom: 7px"
        > Mais Novos (Padrão)</button>

        <button
            wire:click="orderProducts('oldest')"
            type="button"
            class="btn-small waves-effect waves-light blue darken-4"
            style="margin-bottom: 7px"
        > Mais Antigos </button>

        <button
            wire:click="orderProducts('price', 'desc')"
            type="button"
            class="btn-small waves-effect waves-light blue darken-4"
            style="margin-bottom: 7px"
        > Maior Valor → Menor Valor </button>

        <button
            wire:click="orderProducts('price', 'asc')"
            type="button"
            class="btn-small waves-effect waves-light blue darken-4"
            style="margin-bottom: 7px"
        > Menor Valor → Maior Valor </button>

        <button
            wire:click="orderProducts('stock', 'desc')"
            type="button"
            class="btn-small waves-effect waves-light blue darken-4"
            style="margin-bottom: 7px"
        > Maior Quantidade → Menor Quantidade </button>

        <button
            wire:click="orderProducts('stock', 'asc')"
            type="button"
            class="btn-small waves-effect waves-light blue darken-4"
            style="margin-bottom: 7px"
        > Menor Quantidade → Maior Quantidade </button>
    </div>

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
            @foreach ($this->products as $product)
                @if ($product->stock > 0)
                    <tr wire:key="{{ $product->id }}">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->stock }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn blue darken-4">
                                <i class="material-icons right">info</i>Visualizar Produto</a>
                        </td>              
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <br>

    <h5>Produtos não disponíveis</h5>
    <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
        <thead>
            <tr>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Nome</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Descrição</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Preço</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->products as $product)
                @if ($product->stock <= 0)
                    <tr>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn blue darken-4">
                                <i class="material-icons right">info</i>Visualizar Produto</a>
                        </td>             
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
