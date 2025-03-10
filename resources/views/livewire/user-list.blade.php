<div>
    <div class="row">
        <form class="col s12">
            <div class="input-field col s4">
                <input placeholder="Busque um usuário!" id="searchInput" type="text" wire:model.live="searchInput" class="center-align">
                <label class="label-icon right" for="searchInput"><i class="material-icons">search</i></label>
            </div>
        </form>

        @if ($sortByName || $sortByDate || $sortByProducts)
            <div>
                <strong>Ordenando por:</strong> {{ $sortByName ? 'Nome de Usuário' : ($sortByDate ? 'Data do Cadastro' : ($sortByProducts ? 'Quantidade de Produtos' : ''))}}

                <a href="#" wire:click="resetOrder" class="waves-effect waves-light btn-small blue darken-4">Resetar</a>
            </div>
        @endif
    </div>

    @if ($users->isEmpty())
        <table class="min-w-full highlight centered">
            <thead>
                <tr>
                    <th>Nenhum usuário localizado!</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    @else
        <table class="min-w-full highlight centered">
            <thead>
                <tr>
                    <th><a href="#" wire:click.prevent="$toggle('nameAsc')" style="color: black">Nome de Usuário {{ $sortByName ? ($nameAsc ? '🠋' : '🠉') : ''}}</a></th>
                    <th><a href="#" wire:click.prevent="$toggle('dateAsc')" style="color: black">Data do Cadastro {{ $sortByDate ? ($dateAsc ? '🠋' : '🠉') : ''}}</a></th>
                    <th><a href="#" wire:click.prevent="$toggle('productsAsc')" style="color: black">Quantidade de Produtos {{ $sortByProducts ? ($productsAsc ? '🠋' : '🠉') : ''}}</a></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td>{{ $user->name }}</td>
                        <td>{{$user->created_at->format('d/m/Y')}}</td>
                        <td>{{count($user->products)}}</td>
                        <td>
                            <a href="{{route('user.details', $user->id)}}" class="waves-effect waves-light btn-small blue darken-4">
                                Visualizar Usuário<i class="material-icons right">info</i></a>
                        </td>              
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>

    <div>
        {{ $users->links('pagination') }}
    </div>
</div>
