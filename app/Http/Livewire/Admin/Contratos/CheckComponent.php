<?php

namespace App\Http\Livewire\Admin\Contratos;

use Livewire\Component;
use App\Models\Checkin;

class CheckComponent extends Component
{
    public $check = false;
    public $table;

    public function mount($table)
    {
        $this->table = $table;
        // Inicializa o estado do checkbox com base no valor no banco
        $this->check = $table->check;
    }

    public function updatedCheck($value)
    {
        Checkin::find($this->table->id)->update([
            'check' => $value ? true : false,
        ]);

        $this->emit('refreshCheckinComponent');
    }



    public function render()
    {
        return view('livewire.admin.contratos.check.check-component');
    }
}
