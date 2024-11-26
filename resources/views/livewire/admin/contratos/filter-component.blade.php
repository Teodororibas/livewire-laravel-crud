<div>
    <div class="b-example-divider"></div>
    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">


    {{-- modal filters --}}

    <div wire:ignore.self class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Cadastro</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="name" class="form-control" id="name" required wire:model.defer="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="colorSelect" class="form-label">Escolha uma cor:</label>
                        @error('color') <span class="text-danger">{{ $message }}</span> @enderror
                        <select id="colorSelect" class="form-select" wire:model="color">
                            <option value="">Selecione uma cor</option>
                            <option value="primary">Primary</option>
                            <option value="secondary">Secondary</option>
                            <option value="success">Success</option>
                            <option value="danger">Danger</option>
                            <option value="warning">Warning</option>
                            <option value="info">Info</option>
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="cancel">Cancelar</button>
              <button type="button" class="btn btn-primary" wire:click="store">Salvar </button>
            </div>
          </div>
        </div>
    </div>


    <div class="dropdown-menu d-block position-static pt-0 mx-0 rounded-3 shadow overflow-hidden w-280px  {{$color}}">

        <div class="d-grid gap-2 p-2">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#storeModal">Adicionar</button>
        </div>
        <form class="p-2 mb-2 bg-body-tertiary border-bottom">
            <input type="search" wire:model="search" class="form-control" placeholder="Filtre aqui...">
        </form>
        <ul class="list-unstyled mb-0 text-primary">
            @foreach ($filters as $item)

                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#">
                    <span class="d-inline-block bg-{{ $item->color }} rounded-circle p-1"></span>
                    {{ $item->name }}

                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#storeModalEdit{{$item->id}}" wire:click.prev="edit({{$item}})">Editar</button>

                    {{-- modal editar --}}

                    <div wire:ignore.self class="modal fade" id="storeModalEdit{{$item->id}}" tabindex="-1" aria-labelledby="storeModalLabel{{$item->id}}" aria-hidden="true" data-bs-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabe{{$item->id}}">Editar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="name" class="form-control" id="name" required wire:model.defer="name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="colorSelect" class="form-label">Escolha uma cor:</label>
                                        <select id="colorSelect" class="form-select" wire:model="color">
                                            <option value="">Selecione uma cor</option>
                                            <option value="primary">Primary</option>
                                            <option value="secondary">Secondary</option>
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="warning">Warning</option>
                                            <option value="info">Info</option>
                                            <option value="light">Light</option>
                                            <option value="dark">Dark</option>
                                        </select>
                                    </div>
                                </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="cancel">Cancelar</button>
                                <button type="button" class="btn btn-primary" wire:click.prevent="update" data-bs-dismiss="modal" >Salvar</button>
                                </div>
                            </div>
                        </div>
                      </div>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir{{ $item->id }}">Excluir</button>

                    {{-- modal excluir --}}

                    <div wire:ignore.self class="modal fade" id="modalExcluir{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Excluir</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja Excluir id {{ $item->id }}?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                    <button  wire:click="destroy({{ $item->id }})" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a></li>
            @endforeach
            {{ $filters->links() }}
        </ul>
    </div>
</div>
