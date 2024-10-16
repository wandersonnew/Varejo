<div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Adicionar
    </button>

    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Novo produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
            
                <form wire:submit="save">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Digite a nova categoria" wire:model.blur="nome">
                        @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" wire:model="descricao"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Preço de compra</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="R$ 00,00" wire:model="preco_compra">
                        @error('preco_compra') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Preço de venda</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="R$ 00,00" wire:model="preco_venda">
                        @error('preco_venda') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantidade a ser adicionada</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="R$ 00,00" wire:model="quantidade_estoque">
                        @error('quantidade_estoque') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select class="form-select" id="categoria_id" aria-label="Selecione uma categoria" wire:model="categoria_id">
                            <option value="" selected>Selecione uma categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imagem</label>
                        <input accept="image/png, image/jpeg, image/jpg" class="form-control" type="file" id="formFile" wire:model="imagem_url">
                        @error('imagem_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        @if ($imagem_url) 
                            <img src="{{ $imagem_url->temporaryUrl() }}" width="100px">
                        @endif
                    </div>

                    <button id="send" class="btn btn-primary" type="submit">Cadastrar</button>
                </form>

            </div>
        </div>
    </div>

</div>

@script
<script>
    // document.getElementById("send").addEventListener("click", function(event){
    //     event.preventDefault()
    // });
</script>
@endscript