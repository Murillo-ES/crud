<div>
    <div>
        <a id="toggleSortMenu" class='btn blue darken-4' style="margin-bottom: 5px">Ordenar Por...</a>
    
        <div id="sortOptions" style="display: none; margin-bottom: 5px;">
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
        </div>
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
            @foreach ($products as $product)
                @if ($product->stock > 0)
                    <tr wire:key="{{ $product->id }}">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->stock }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
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
        {{ $products->links() }}
    </div>

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
            @foreach ($emptyProducts as $product)
                <tr wire:key="{{ $product->id }}">
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->name }}</td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">{{ $product->description }}</td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                        <a href="{{route('products.show', $product->id)}}" class="waves-effect waves-light btn-small blue darken-4">
                            Visualizar Produto</a>
                    </td>             
                </tr>
            @endforeach
        </tbody>
    </table>

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
