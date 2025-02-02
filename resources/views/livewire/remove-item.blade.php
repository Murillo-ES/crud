<div>
    <div class="modal" style="display:block; position: fixed; top: 0; left:0; width: 100%; height: 120%; background: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background: #fff; margin: 10% auto; padding: 20px; width: 300px; height: 250px; text-align: center; color: #000;">
                <p>Selecione uma quantidade para remover:</p>
            <form wire:submit="remove">
                <input type="hidden" wire:model="productId" value="{{$productId}}">
                <div class="input-field inline">
                    <label for="quantity"><strong>Quantidade:</strong></label>
                    <input type="number" name="quantity" wire:model="quantity" min="1" max="{{$quantity}}">
                </div>
                <div class="modal-footer" style="margin-top: 5px;">
                    <button type="submit" class="btn red" style="margin-right: 10px;">Remover</button>
                    <button type="button" wire:click="$dispatch('closeModal')" class="btn grey">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>