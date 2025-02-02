<div>
    <div class="modal" style="display:block; position: fixed; top: 0; left:0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background: #fff; margin: 10% auto; padding: 20px; width: 300px; text-align: center; color: #000;">
            <h4>Confirmação</h4>
            <p>Tem certeza que deseja excluir este produto?</p>
            <div class="modal-footer" style="margin-top: 20px;">
                <button wire:click="delete" class="btn red" style="margin-right: 10px;">Confirmar</button>
                <button wire:click="$dispatch('closeModal')" class="btn grey">Cancelar</button>
            </div>
        </div>
    </div>
</div>