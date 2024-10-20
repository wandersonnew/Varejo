<div>

    <div class="card">
        <div class="card-body">


            <form wire:submit="search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Busque pelo produto" wire:model="searchvalue">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <form wire:submit.prevent="searchCustomer">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Busque pelo CPF do cliente" wire:model="cpf">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                @error('cpf') <span class="text-danger">{{ $message }}</span> @enderror
            </form>

            @if ($customer)
                <div class="mb-3">
                    <div id="emailHelp" class="form-text text-center text-success">
                        {{ $customer->nome }}
                    </div>
                </div>
            @endif

            @if ($cartItems && $cartItems->isNotEmpty())
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-success  bi bi-cart-check-fill btn-lg"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="getItensCart()"></button>
                </div>
            @else
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-secondary  bi bi-cart btn-lg"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="getItensCart()"></button>
                </div>
            @endif


        </div>
    </div>

    @if ($products && $products->isNotEmpty())

        <div class="card-group mt-4">
            @foreach ($products as $product)

                <div class="card">
                    <img src="{{ Storage::url($product->imagem_url) }}" class="card-img-top" alt="{{ $product->nome }}" style="height: 200px; width: 100%; object-fit: contain;">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5 class="card-title">{{ $product->nome }}</h5>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">{{ $product->descricao }}</p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text"><small class="text-body-secondary">R$ {{ $product->preco_venda }}</small></p>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center text-body-secondary">
                        <button type="button" class="btn btn-secondary" onclick="addToCart({{ $product->id }})">Adicionar ao carrinho</button>
                    </div>
                </div>

            @endforeach
        </div>

    @else
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Não há registro</h4>
                <i class="bi bi-inboxes" style="font-size: 3rem; color: cornflowerblue;"></i>
            </div>
        </div>
    @endif     

    <!-- modal -->

    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Carrinho de compras</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
            
                @if ($cartItems && $cartItems->isNotEmpty())

                    <div class="card-group mt-4">
                        @foreach ($cartItems as $cartItem)

                            <div class="card">
                            <img src="{{ Storage::url($cartItem->imagem_url) }}" alt="{{ $cartItem->nome }}" style="height: 80px; width: auto;">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <h5 class="card-title">{{ $cartItem->nome }}</h5>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="card-text">
                                                Quantidade: {{ $cartItem->quantidade }}
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-success bi bi-cart-plus" onclick="addToCart({{ $cartItem->id }})"></button>
                                                    <button type="button" class="btn btn-danger bi bi-cart-dash" onclick="removeFromCart({{ $cartItem->id }})"></button>
                                                </div>
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="card-text"><small class="text-body-secondary">Preço unitário: R$ {{ $cartItem->preco_venda }}</small></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>                        
                            
                        @endforeach
                        
                    </div>
                    <div class="mt-3">
                        <h4>Total: R$ {{ $total_venda }}</h4>
                    </div>

                    <hr>
                    <h5 class="text-center">Finalizar Compra</h5>

                    @if ($customer)
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cupom de desconto" id="desconto">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="finishSale({{ $total_venda }})">
                                Finalizar compra
                            </button>
                        </div>
                    @else
                        <div class="mb-3">
                            <div id="emailHelp" class="form-text text-center text-success">
                                Para finalizar a compra busque o cliente pelo CPF.
                            </div>
                        </div>
                    @endif

                    
                @else
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Não há registro</h4>
                            <i class="bi bi-inboxes" style="font-size: 3rem; color: cornflowerblue;"></i>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    
</div>



<script>
    function addToCart(productId)
    {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let item = cart.find(product => product.id === productId);

        if (item) item.quantidade += 1;
        else cart.push({ id: productId, quantidade: 1 });

        localStorage.setItem('cart', JSON.stringify(cart));
        @this.call('addToCart', cart);
        alert('Item adicionado ou quantidade atualizada');
    }

    function removeFromCart(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        let item = cart.find(product => product.id === productId);

        if (item) {
            if (item.quantidade > 1) {
                item.quantidade -= 1;
            } else {
                cart = cart.filter(product => product.id !== productId);
            }
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        @this.call('addToCart', cart);
        alert('Item removido ou quantidade atualizada');
    }

    window.addEventListener('beforeunload', function () {
        localStorage.removeItem('cart');
    });

    function finishSale(totalVenda)
    {
        var desconto = document.getElementById('desconto').value;

        var vendaInfo = {
            totalVenda: totalVenda,
            desconto: desconto,
            cart: JSON.parse(localStorage.getItem('cart'))
        };

        @this.call('finishSale', vendaInfo);
    }

</script>
