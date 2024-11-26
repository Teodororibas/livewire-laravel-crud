<?php

namespace App\Http\Livewire\Admin\Contratos;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\System;

class SystemComponent extends Component
{

    private $systens;
    public $name, $email, $cpf, $numero;
    public $itemId;
    public $openForm = false;
    public $search;

    use WithPagination;//para incluir paginação no blade
    protected $paginationTheme = 'bootstrap'; // Estilo de paginação com Bootstrap


    public function render()
    {
        // consulta a paginação e filtro baseado na pesquisa
        $systens = System::when($this->search, function($query) {
            return $query->where('name', 'like', '%' . $this->search . '%')
                         ->orWhere('email', 'like', '%' . $this->search . '%')
                         ->orWhere('cpf', 'like', '%' . $this->search . '%')
                         ->orWhere('numero', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'asc') // Adiciona ordenação fixa
           ->paginate(3);

        return view('livewire.admin.contratos.system-component', [
            'systens' => $systens,
        ]);
    }


    protected $listeners = [
        'deleteCategory'=>'destroy'
    ];

    // Validation Rules
    protected $rules = [
        'name'=>'required',
        'email'=>'required',
        'cpf'=>'required',
        'numero'=>'required',
    ];


    public function resetFields(){
        $this->itemId = null;
        $this->name = null;
        $this->email = null;
        $this->cpf = null;
        $this->numero = null;

    }

    public function store(){
        // $this->openForm = true;
    // dd($this->name);
        $this->validate();
        // dd($this->title);
        try{
            System::create([
                'name'=> $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'numero' => $this->numero
            ]);


            session()->flash('success','Conta criada com Sucesso!!');

            $this->resetFields();
            $this->emit('refreshCrudTable');
        }catch(\Exception $e){

            session()->flash('error','Erro ao criar a Conta!');

            $this->resetFields();
        }
    }


    public function create(){
        $this->cancel();
        $this->openForm = true;
    }

    public function edit($data,$type){
        if($type == 'form'){
            $this->openForm = true;
        }

    //    dd($data);
            // dd($title,$description,$category_id);
            // $category_id= System::findOrFail();
        if($data){
            $this->itemId = $data['id'];
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->cpf = $data['cpf'];
            $this->numero = $data['numero'];
        }

    }


    public function cancel()
    {
        $this->resetFields();
        $this->openForm = false;
    }


    public function update(){


        $this->validate();
        try{
            System::find($this->itemId)->fill([
                'name'=>$this->name,
                'email'=>$this->email,
                'cpf'=>$this->cpf,
                'numero'=>$this->numero
            ])->save();
            session()->flash('success','Category Updated Successfully!!');

            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating category!!');
            $this->cancel();
        }
    }
    public function destroy($item_id){
    //    dd($item_id);
        try{
           $delete = System::find($item_id);
           $delete ? $delete->delete() : null;
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting category!!");
        }
    }


}
