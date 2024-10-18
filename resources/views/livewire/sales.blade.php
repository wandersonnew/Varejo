<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cupom de Desconto</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="cupom_desconto">
            @error('cupom_desconto') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>


{{-- ,$cliente_id
        ,$data_venda
        ,$total_venda
        ,$cupom_desconto
        ,$total_final
        ,$status; --}}
