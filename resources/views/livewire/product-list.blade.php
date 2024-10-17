<div>
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
                                <img src="{{ Storage::disk('public')->getVisibility($product->imagem_url) }}" alt="{{ $product->nome }}">
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                <button type="button" class="btn btn-warning bi bi-pencil"></button>
                                <button type="button" class="btn btn-success bi bi-plus-circle"></button>

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
        <div class="text-center">
            <h4>Não há registro</h4>
            <i class="bi bi-inboxes" style="font-size: 3rem; color: cornflowerblue;"></i>
        </div>
    @endif

 
</div>
