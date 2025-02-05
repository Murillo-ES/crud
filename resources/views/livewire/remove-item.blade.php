<div>
    <button data-target="modal1" class="btn modal-trigger red">Remover</i></button>

    <div id="modal1" class="modal" style="background: #fff; margin: 10% auto; padding: 20px; height:270px; width: 500px; text-align: center; color: #000;">
        <div class="modal-content">
            <p>Selecione uma quantidade para remover:</p>
            <form wire:submit="remove">
                <input type="hidden" wire:model="productId" value="{{$productId}}">
                <div>
                    <label for="quantity"><strong>Quantidade:</strong></label>
                    <input type="number" name="quantity" wire:model="quantity" min="1" max="{{$quantity}}">
                </div>
                <div class="modal-footer" style="margin-top: 5px;">
                    <button type="submit" class="btn red" style="margin-right: 10px;">Remover</button>
                    <button type="button" class="btn grey modal-close">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>