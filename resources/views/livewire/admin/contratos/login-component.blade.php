<div>
    <div class="b-example-divider"></div>

    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Senha</th>
                        </tr>
                    </thead>
                    <input type="search" wire:model="search" class="form-control w-100" placeholder="Filtre aqui...">
                    <tbody>
                        @foreach ($logins as $form)
                            <tr>
                                <th scope="row">{{ $form->id }}</th>
                                <td>{{ $form->name }}</td>
                                <td>{{ $form->password }}</td>

                                <td>

                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $form }})">Editar</button>

                                    <button class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#myModal{{ $form->id }}">Deletar</button>

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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $logins->links() }}
            </div>

            <!-- Formulário de criação e edição -->
            <div class="col-md-10 mx-auto col-lg-5">
                <div class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name" required wire:model.defer="name">
                        <label for="floatingInput">Nome</label>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required wire:model.defer="password">
                        <label for="floatingPassword">Senha</label>
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <div class="mb-3">
                        @if($itemId)
                            <button class="w-100 btn btn-lg btn-warning mb-2" type="submit" wire:click="update({{ $form->id }})">Editar</button>
                            <button class="w-100 btn btn-lg btn-danger" type="submit" wire:click="cancel">Cancelar</button>
                        @else
                            <button class="w-100 btn btn-lg btn-primary" type="submit" wire:click="store">Salvar</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
