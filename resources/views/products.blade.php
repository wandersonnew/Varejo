<x-layoutbootstrap>
    <x-slot:title>
        Produtos
    </x-slot>

        
        <div class="row align-items-center">
            <div class="col-12 min-vh-30 bg-body-secondary text-center">
                Navbar
            </div>
            <div class="col-3 min-vh-100 bg-warning-subtle text-center">
                Menu
            </div>
            <div class="col-9 min-vh-100 bg-secondary-subtle">
            
                <h1 class="text-center">Produtos</h1>
        
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <livewire:producta-dd />

                <livewire:product-list />

            </div>
        </div>
</x-layoutbootstrap>