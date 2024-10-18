<div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" wire:click="resetForm">
        Adicionar
    </button>

    @if ($customers && $customers->isNotEmpty())

    <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <th scope="row">{{ $customer->id }}</th>
                        <td>{{ $customer->nome }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->telefone }}</td>
                        <td>{{ $customer->cpf }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                <button type="button" class="btn btn-warning bi bi-pencil" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  wire:click="edit({{ $customer->id }})"></button>

                                <button class="btn btn-danger bi bi-trash"
                                wire:click="deleteConfirmation({{ $customer->id }})"
                                wire:confirm="Deseja Deletar?"></button>

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

    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Clientes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
            
                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="nome">
                        @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTel" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="exampleInputTel" wire:model="telefone">
                        @error('telefone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputCpf" class="form-label">CPF</label>
                        <input type="number" class="form-control" id="exampleInputCpf" wire:model="cpf">
                        @error('cpf') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>

            </div>
        </div>
    </div>

</div>
