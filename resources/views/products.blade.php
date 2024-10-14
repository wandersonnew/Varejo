<x-layoutbootstrap>
    <x-slot:title>
        Produtos
    </x-slot>

        <h1 class="text-center">Produtos</h1>

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    
        <livewire:productadd />

        <livewire:productstable />
        
</x-layoutbootstrap>