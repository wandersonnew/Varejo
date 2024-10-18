<x-layoutbootstrap>
    <x-slot:title>
        Clientes
    </x-slot>
    <x-slot:navtitle>
        Clientes
    </x-slot>

        <div class="container-fluid">
            <div class="row flex-nowrap">
            
                <x-sidebar />

                <div class="col py-3">
        
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
