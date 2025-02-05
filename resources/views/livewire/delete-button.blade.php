<div>
    <button data-target="modal1" class="btn modal-trigger red accent-4">Excluir Produto <i class="material-icons right">delete</i></button>

    <div id="modal1" class="modal" style="background: #fff; margin: 10% auto; padding: 20px; height:220px; width: 500px; text-align: center; color: #000;">
        <div class="modal-content">
            <h4>Confirmação</h4>
            <p>Tem certeza que deseja excluir este produto?</p>
        </div>
        <div class="modal-footer">
            <button wire:click="delete" class="btn red" style="margin-right: 10px;">Confirmar</button>
            <button type="button" class="btn grey modal-close">Cancelar</button>
        </div>
    </div>
</div>