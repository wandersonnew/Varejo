<div>
    <!-- <div class="container" style="background-color:white; height:100vh;"> -->

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
        </div>
    </div>

    @if ($products && $products->isNotEmpty())

        <div class="card-group mt-4">
            @foreach ($products as $product)

                <div class="card">
                    <img src="{{ Storage::url($product->imagem_url) }}" class="card-img-top" alt="{{ $product->nome }}" style="height: 200px; width: 100%; object-fit: contain;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nome }}</h5>
                        <p class="card-text">{{ $product->descricao }}</p>
                        <p class="card-text"><small class="text-body-secondary">R$ {{ $product->preco_venda }}</small></p>
                    </div>
                    <div class="card-footer text-center text-body-secondary">
                        <button class="btn btn-secondary" wire:click="addToCart({{ $product->id }})">Adicionar ao carrinho</button>
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


    <!-- </div> -->
</div>
