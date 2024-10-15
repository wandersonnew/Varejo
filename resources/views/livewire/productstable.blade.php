<div>
    @if ($products && $products->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço da Compra</th>
                    <th scope="col">Preço da Venda</th>
                    <th scope="col">Qtd. Estoque</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->nome }}</td>
                        <td>{{ $product->descricao }}</td>
                        <td>{{ number_format($product->preco_compra, 2, ',', '.') }}</td>
                        <td>{{ number_format($product->preco_venda, 2, ',', '.') }}</td>
                        <td>{{ $product->quantidade_estoque }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button 
                                    type="button"
                                    class="btn btn-danger bi bi-trash"
                                    wire:click="deleteConfirmation({{ $product->id }})"
                                    wire.confirm="Deseja deletar este produto?"
                                ></button>
                                <!-- <button type="button" class="btn btn-warning bi bi-pencil"></button> -->
                                <livewire:productedit />
                            </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <h4>Não há registro</h4>
            <i class="bi bi-inboxes" style="font-size: 3rem; color: cornflowerblue;"></i>
        </div>
    @endif
</div>

@script
<script>
    // window.addEventListener('show-delete-confirmation', event => {
    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "You won't be able to revert this!",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Yes, delete it!"
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Livewire.emit('deleteConfirmed')
    //             Swal.fire({
    //             title: "Deleted!",
    //             text: "Your file has been deleted.",
    //             icon: "success"
    //             });
    //         }
    //     });
    // })
</script>
@endscript