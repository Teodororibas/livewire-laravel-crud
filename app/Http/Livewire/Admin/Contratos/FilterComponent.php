<?php

namespace App\Http\Livewire\Admin\Contratos;


use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Filter;


class FilterComponent extends Component
{
    public $name, $color;
    public $itemId;
    public $search;

    use WithPagination;//para incluir paginação no blade
    protected $paginationTheme = 'bootstrap'; // Estilo de paginação com Bootstrap

    public function render()
    {
        // consulta a paginação e filtro baseado na pesquisa
        $filters = Filter::when($this->search, function($query) {
            return $query->where('name', 'like', '%' . $this->search . '%')
                         ->orWhere('color', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'asc') // Adiciona ordenação fixa
           ->paginate(3);

        return view('livewire.admin.contratos.filter-component', [
            'filters' => $filters,
        ]);
    }

    protected $listeners = [
        'deleteCategory'=>'destroy'
    ];
    // Validation Rules
    protected $rules = [
        'name'=>'required',
        'color'=>'required',
    ];


    public function resetFields(){
        $this->name = null;
        $this->itemId = null;
        $this->color = null;

    }

    public function store(){
        // Validate Form Request
        $this->validate();
        try{
            // Create Category
            Filter::create([
                'name'=>$this->name,
                'color'=>$this->color,
            ]);

            // Set Flash Message
            session()->flash('success','Category Created Successfully!!');
            // Reset Form Fields After Creating Category
            $this->resetFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating category!!');
            // Reset Form Fields After Creating Category
            $this->resetFields();
        }
    }

    public function edit($data){
        if($data == 'item'){}

    //    dd($data);
            // dd($title,$description,$category_id);
            // $category_id= System::findOrFail();
        if($data){
            $this->itemId = $data['id'];
            $this->name = $data['name'];
            $this->color = $data['color'];
        }
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function update(){
        // Validate request
        $this->validate();
        try{
            // Update category
            Filter::find($this->itemId)->fill([
                'name'=>$this->name,
                'color'=>$this->color,
            ])->save();
            session()->flash('success','Category Updated Successfully!!');

            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating category!!');
            $this->cancel();
        }
    }

    public function destroy($item_id){
        // dd($item_id);
         try{
            $delete = Filter::find($item_id);
            $delete ? $delete->delete() : null;
             session()->flash('success',"Category Deleted Successfully!!");
         }catch(\Exception $e){
             session()->flash('error',"Something goes wrong while deleting category!!");
         }
     }


}
