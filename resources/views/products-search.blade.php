<x-layoutbootstrap>
    <x-slot:title>
        Produtos
    </x-slot>

        <div class="container-fluid">
            <div class="row flex-nowrap">
            
                <x-sidebar />

                <div class="col py-3">
                    <h1 class="text-center">Buscar produtos</h1>
                    <hr>
        
                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
        
</x-layoutbootstrap>
