<div>

    <!-- tabela -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">CPF</th>
                <th scope="col">Número</th>
                <th scope="col">

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#storeModal">Store</button>

                    <button class="btn btn-warning btn-sm" wire:click="create">Novo</button>

                </th>
            </tr>
        </thead>
        <tbody>

            <form class="p-2 mb-2 bg-body-tertiary border-bottom d-flex justify-content-center">
                <input type="search" wire:model="search" class="form-control w-50" placeholder="Filtre aqui...">
            </form>

            @foreach ($systens as $form)
                <tr>
                <th scope="row">{{ $form->id }}</th>
                <td>{{ $form->name }}</td>
                <td>{{ $form->email }}</td>
                <td>{{ $form->cpf }}</td>
                <td>{{ $form->numero }}</td>

                <td>
                    <button class="btn btn-primary btn-sm" wire:click="edit({{ $form }}, 'form')">Editar</button>

                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="edit({{$form}}, 'modal')">Modal</button>


                    {{-- modal editar --}}

                    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nome</label>
                                            <input type="name" class="form-control" id="name" required wire:model.defer="name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" wire:model.defer="email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cpf" class="form-label">CPF</label>
                                            <input type="cpf" class="form-control" id="cpf" wire:model.defer="cpf" required>

                                        </div>
                                            <div class="mb-3">
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="numero" class="form-control" id="numero" wire:model.defer="numero" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary"  data-bs-dismiss="modal" wire:click="update" >Salvar alterações</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{ $form->id }}">Excluir</button>

                    {{-- modal excluir --}}

                    <div wire:ignore.self class="modal fade" id="myModal{{ $form->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Excluir</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja Excluir id {{ $form->id }}?</p>
                                </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                    <button wire:click="destroy({{ $form->id }})" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- modal store --}}

                    <div wire:ignore.self class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel"> Cadastro</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="mb-3">
                                  <label for="name" class="form-label">Nome</label>
                                  <input type="text" class="form-control" id="name" required wire:model.defer="name">
                                  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="text" class="form-control" id="email" wire:model.defer="email" required>
                                  @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="cpf" class="form-label">CPF</label>
                                  <input type="text" class="form-control" id="cpf" wire:model.defer="cpf" required>
                                  @error('cpf') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="numero" class="form-label">Número</label>
                                  <input type="number" class="form-control" id="numero" wire:model.defer="numero" required>
                                  @error('numero') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                              <button type="button" class="btn btn-primary" wire:click="store({{$form}})" >Salvar </button>
                            </div>
                          </div>
                        </div>
                    </div>
                </td>
              </tr>
            @endforeach

        </tbody>
    </table>

    {{ $systens->links() }}

    <!-- formulario -->

    @if ($openForm)
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                <div class="form-floating mb-3">
                    <input type="name" class="form-control" required wire:model.defer="name">
                    <label for="floatingInput">Nome</label>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" required wire:model.defer="email">
                    <label for="floatingInput">Email</label>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" required wire:model.defer="cpf">
                    <label for="floatingInput">CPF</label>
                    @error('cpf') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" required wire:model.defer="numero">
                    <label for="floatingPassword">Número</label>
                    @error('numero') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="mb-3">
                    @if($itemId)
                        <button class="w-100 btn btn-lg btn-warning mb-2" wire:click.prevent="update" type="submit">Editar</button>
                    @else
                        <button class="w-100 btn btn-lg btn-primary mb-2" wire:click.prevent="store" type="submit">Salvar</button>
                    @endif
                        <button type="button" class="w-100 btn btn-lg btn-danger"  wire:click.prevent="cancel" data-bs-dismiss="modal">Fechar</button>
                </div>

                <hr class="my-4">
                <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
            </form>
        </div>
    @endif
</div>
