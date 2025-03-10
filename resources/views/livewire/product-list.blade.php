<div>
    <div>
        <a id="toggleSortMenu" class='btn blue darken-4' style="margin-bottom: 5px">Ordenar Por...</a>
    
        <div id="sortOptions" class="center-align" style="display: none; margin-bottom: 5px;">
            <button wire:click="orderProducts('oldest')" type="button" class="btn-small waves-effect waves-light blue darken-4">
                Mais Antigos
            </button>
    
            <button wire:click="orderProducts('latest')" type="button" class="btn-small waves-effect waves-light blue darken-4">
                Mais Novos
            </button>
    
            <button wire:click="orderProducts('price', 'desc')" type="button" class="btn-small waves-effect waves-light blue darken-4">
                Valor <i class="tiny material-icons right">arrow_downward</i>
            </button>
    
            <button wire:click="orderProducts('price', 'asc')" type="button" class="btn-small waves-effect waves-light blue darken-4">
                Valor <i class="tiny material-icons right">arrow_upward</i>
            </button>
    
            <button wire:click="orderProducts('stock', 'desc')" type="button" class="btn-small waves-effect waves-light blue darken-4">
                Quantidade <i class="tiny material-icons right">arrow_downward</i>
            </button>
    
            <button wire:click="orderProducts('stock', 'asc')" type="button" class="btn-small waves-effect waves-light blue darken-4">
                Quantidade <i class="tiny material-icons right">arrow_upward</i>
            </button>

            <br>

            <div class="row" style="margin-top: 10px">
                <form wire:submit="valueFilter">
                    <div class="col s6">
                        <label for="minPrice">Selecione um valor mínimo:</label>
                        <input type="number" name="minPrice" wire:model="minPrice" step="0.01" min="0">
                    </div>

                    <div class="col s6">
                        <label for="maxPrice">Selecione um valor máximo:</label>
                        <input type="number" name="maxPrice" wire:model="maxPrice" step="0.01" min="$this->minPrice">
                    </div>

                    <input type="submit" hidden />
                </form>
            </div>

        </div>
    </div>

    <table class="min-w-full highlight centered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade Disponível</a>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                @if ($product->stock > 0)
                    <tr wire:key="{{ $product->id }}">
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn-small blue darken-4">
                                Visualizar Produto</a>
                        </td>              
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <br>

    <div>
        {{ $products->links('pagination') }}
    </div>

    <br>

    @if (count($emptyProducts) != 0)
        <h5>Produtos não disponíveis</h5>

        <table class="min-w-full highlight centered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emptyProducts as $product)
                    <tr wire:key="{{ $product->id }}">
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn-small blue darken-4">
                                Visualizar Produto</a>
                        </td>             
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var toggleButton = document.getElementById("toggleSortMenu");
            var sortMenu = document.getElementById("sortOptions");
    
            // Toggle the sorting menu when clicking the button
            toggleButton.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevents the click from triggering the "click outside" event
                sortMenu.style.display = (sortMenu.style.display === "none" || sortMenu.style.display === "") ? "block" : "none";
            });
    
            // Prevent closing when clicking inside the menu
            sortMenu.addEventListener("click", function (event) {
                event.stopPropagation();
            });
    
            // Close when clicking outside the menu
            document.addEventListener("click", function (event) {
                if (sortMenu.style.display === "block") {
                    sortMenu.style.display = "none";
                }
            });
        });
    </script>
</div>
