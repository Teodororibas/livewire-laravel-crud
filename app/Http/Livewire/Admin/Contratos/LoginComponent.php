<?php

namespace App\Http\Livewire\Admin\Contratos;


use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Login;

class LoginComponent extends Component
{

    protected $logins;
    public $search;
    public $name, $password;
    public $itemId;
    public $status;

    use WithPagination; //para incluir paginação no blade
    protected $paginationTheme = 'bootstrap'; // Estilo de paginação com Bootstrap

    protected $listeners = [
        'deleteCategory'=>'destroy',
        'refreshCrudTable'=> '$refresh'
    ];

        // Validation Rules
        protected $rules = [
            'name'=>'required',
            'password'=>'required',

        ];

    public function render()
    {
        // consulta a paginação e filtro baseado na pesquisa
        $logins = Login::when($this->search, function($query) {
            return $query->where('name', 'like', '%' . $this->search . '%')
                         ->orWhere('password', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'asc') // Adiciona ordenação fixa
            ->paginate(3);

        return view('livewire.admin.contratos.login-component', [
            'logins' => $logins,
        ]);
    }

    public function resetFields(){
        $this->itemId = null;
        $this->name = null;
        $this->password = null;

    }

    public function store(){
    // dd('$this->name');
        $this->validate();
        // dd($this->name);
        try{
            Login::create([
                'name'=> $this->name,
                'password'=> $this->password
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
    }

    public function edit($data){
        if($data == 'form'){
        }
            //    dd($data);
            // dd($title,$description,$category_id);
            // $category_id= System::findOrFail();
        if($data){
            $this->itemId = $data['id'];
            $this->name = $data['name'];
            $this->password = $data['password'];
        }
    }


    public function cancel()
    {
        $this->resetFields();
    }

    public function update(){
        $this->validate();
        try{
            Login::find($this->itemId)->fill([
                'name'=>$this->name,
                'password'=>$this->password,

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
           $delete = Login::find($item_id);
           $delete ? $delete->delete() : null;
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting category!!");
        }
    }
}
