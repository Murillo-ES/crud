<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
        <h2>Token API</h2>

        @if ($plainTextToken == '')
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Crie um token clicando no botão abaixo!</th>
                    </tr>
                </thead>
            </table>
        @else
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 highlight centered">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black">Token</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-black"><strong>{{ $plainTextToken }}</strong></td>
                    </tr>
                </tbody>
            </table>

        <br>

        <p class="center-align">
            <strong>ATENÇÃO!</strong>
            <br>
            Copie este token e cole em local de segurança! Ao sair desta página, o mesmo não poderá ser recuperado.
        </p>
        @endif

        <br>

        <form wire:submit="newToken" class="center-align">
            <button type="submit" class="btn blue darken-4 waves-effect waves-light">
                <i class="material-icons left">api</i> Novo Token
            </button>
        </form>
    </div>
</div>
