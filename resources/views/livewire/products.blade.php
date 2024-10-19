<div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" wire:click="resetForm">
        Adicionar
    </button>


    @if ($products && $products->isNotEmpty())
    
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço da Compra</th>
                    <th scope="col">Preço da Venda</th>
                    <th scope="col">Qtd. Estoque</th>
                    <th scope="col">Arquivo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->nome }}</td>
                        <td>{{ number_format($product->preco_compra, 2, ',', '.') }}</td>
                        <td>{{ number_format($product->preco_venda, 2, ',', '.') }}</td>
                        <td>{{ $product->quantidade_estoque }}</td>
                        <td>
                            
                            @if ($product->imagem_url)
                                <img src="{{ Storage::url($product->imagem_url) }}" alt="{{ $product->nome }}" style="height: 80px; width: auto;">
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                <button type="button" class="btn btn-warning bi bi-pencil" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  wire:click="edit({{ $product->id }})"></button>

                                <!-- <button type="button" class="btn btn-success bi bi-plus-circle"></button> -->

                                <button class="btn btn-danger bi bi-trash"
                                wire:click="deleteConfirmation({{ $product->id }})"
                                wire:confirm="Deseja Deletar?"></button>

                            </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}

    @else
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Não há registro</h4>
                <i class="bi bi-inboxes" style="font-size: 3rem; color: cornflowerblue;"></i>
            </div>
        </div>
    @endif

    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Produto</h1>
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
                        <input type="number" class="form-control" id="exampleFormControlInput1" wire:model="quantidade_estoque">
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