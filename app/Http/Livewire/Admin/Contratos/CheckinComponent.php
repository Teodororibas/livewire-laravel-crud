<?php

namespace App\Http\Livewire\Admin\Contratos;


use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Checkin;

class CheckinComponent extends Component
{
    protected $checkins;
    public $check, $table;
    public $itemid;
    public $title, $data_list, $description, $data_final;
    public $time_inicial, $time_final;
    public $itemId;
    public $search;

    use WithPagination; //para incluir paginação no blade
    protected $paginationTheme = 'bootstrap'; // Estilo de paginação com Bootstrap

    protected $listeners = [
        'deleteCategory'=>'destroy',
        'refreshCheckinComponent' => '$refresh',
    ];

        // Validation Rules
        protected $rules = [
            'title'=>'required',
            'data_list'=>'required',
            'description'=>'required',
            'data_final' => 'required|date|after_or_equal:data_list',
            'time_inicial'=>'required',
            'time_final'=>'required',

        ];

    public function render()
    {
        // Consulta com ordenação por ID
        $checkins = Checkin::when($this->search, function($query) {
            return $query->where('data_list', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'asc') // Adiciona ordenação fixa
            ->paginate(3);

        return view('livewire.admin.contratos.check.checkin-component', [
            'checkins' => $checkins,
        ]);
    }


    public function mount($table = null)
    {
        // Se não houver $table, significa que estamos criando um novo item
        if (!$table) {
            $this->check = false;  // Inicializa o checkbox desmarcado
        } else {
            $this->check = $table->check;  // Caso contrário, pega o estado do checkbox do banco
            $this->table = $table;
        }
    }

    public function resetFields(){
        $this->check = false;
        $this->itemId = null;
        $this->title = null;
        $this->description = null;
        $this->data_list = null;
        $this->time_inicial = null;
        $this->data_final = null;
        $this->time_final = null;
    }

    public function store()
    {
        $this->validate();
        try {
            Checkin::create([
                'title' => $this->title,
                'description' => $this->description,
                'data_list' => $this->data_list,
                'time_inicial' => $this->time_inicial,
                'data_final' => $this->data_final,
                'time_final' => $this->time_final,
                'check' => false,  // Garantir que o checkbox seja desmarcado ao criar
            ]);

            session()->flash('success', 'Check-in criado com sucesso!');
            $this->resetFields();  // Limpar os campos após a criação

            $this->emit('refreshCheckinComponent');  // Emitir evento para atualizar
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao criar o Check-in!');
            $this->resetFields();
        }
    }


    public function create(){
        $this->cancel();
    }

    public function edit($data){
        if($data == 'table'){
        }
            //    dd($data);
            // dd($title,$description,$category_id);
            // $category_id= System::findOrFail();
        if($data){
            $this->itemId = $data['id'];
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->data_list = $data['data_list'];
            $this->time_inicial = $data['time_inicial'];
            $this->data_final = $data['data_final'];
            $this->time_final = $data['time_final'];
        }
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function update()
    {
        $this->validate();
        try {
            $checkin = Checkin::find($this->itemId);
            $checkin->update([
                'title' => $this->title,
                'description' => $this->description,
                'data_list' => $this->data_list,
                'time_inicial' => $this->time_inicial,
                'data_final' => $this->data_final,
                'time_final' => $this->time_final,
            ]);

            session()->flash('success', 'Check-in atualizado com sucesso!');

            $this->cancel(); // Limpa os campos após a atualização
        }catch (\Exception $e) {
            session()->flash('error', 'Erro ao atualizar o check-in.');
            $this->cancel();
    }
    }

    public function destroy($item_id){
    //    dd($item_id);
        try{
           $delete = Checkin::find($item_id);
           $delete ? $delete->delete() : null;
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting category!!");
        }
    }

}
