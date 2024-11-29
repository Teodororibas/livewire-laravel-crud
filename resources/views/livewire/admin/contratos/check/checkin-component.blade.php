<div>
    <div class="b-example-divider"></div>

    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
                    <div class="list-group">
                        @foreach ($checkins as $table)
                            <label class="list-group-item d-flex gap-3">
                                <livewire:admin.contratos.check-component :key="$table->id" :table="$table"/>
                                <span class="pt-1 form-checked-content">
                                    <strong>{{ $table->title }}</strong>
                                    <div class="pt-1 form-checked-content">
                                        <span style="font-weight: 500;">{{ $table->description }}</span>
                                    </div>
                                    <small class="d-block text-body-secondary">
                                        <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>{{ $table->data_list }}
                                        <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#alarm" /></svg>{{ $table->time_inicial }}
                                    </small>
                                    <small class="d-block text-body-secondary">
                                        <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>{{ $table->data_final }}
                                        <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#alarm" /></svg>{{ $table->time_final }}
                                    </small>

                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $table }})">Editar</button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{ $table->id }}">Deletar</button>

                                    {{-- Modal excluir --}}
                                    <div wire:ignore.self class="modal fade" id="myModal{{ $table->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Excluir</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem certeza que deseja excluir id {{ $table->id }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                    <button wire:click="destroy({{ $table->id }})" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Excluir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </label>
                        @endforeach

                        <label class="list-group-item d-flex gap-3 bg-body-tertiary">
                            <span class="pt-1 form-checked-content">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" wire:model="search" placeholder="Data">
                                    <label for="floatingInput">Pesquise pela Data</label>
                                </div>
                            </span>
                            {{ $checkins->links() }}
                        </label>
                    </div>
                </div>
            </div>

            {{-- Formulário --}}

            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" wire:submit.prevent="{{ $itemId ? 'update' : 'store' }}">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Titulo" required wire:model.defer="title">
                        <label for="floatingInput">Título</label>
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Descrição" required wire:model.defer="description">
                        <label for="floatingInput">Descrição</label>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" placeholder="Data Inicial" required wire:model.defer="data_list">
                        <label for="floatingInput">Data Inicial</label>
                        @error('data_list') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" placeholder="Hora Inicial" required wire:model.defer="time_inicial">
                        <label for="floatingInput">Hora Inicial</label>
                        @error('time_inicial') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" placeholder="Data Final" required wire:model.defer="data_final">
                        <label for="floatingInput">Data Final</label>
                        @error('data_final') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" placeholder="Hora Final" required wire:model.defer="time_final">
                        <label for="floatingInput">Hora Final</label>
                        @error('time_final') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button class="w-100 btn btn-lg {{ $itemId ? 'btn-warning' : 'btn-primary' }} mb-2" type="submit">
                        {{ $itemId ? 'Editar' : 'Salvar' }}
                    </button>
                    @if($itemId)
                        <button type="button" class="w-100 btn btn-lg btn-danger" wire:click="cancel">Cancelar</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
