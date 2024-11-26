<?php

namespace App\Http\Livewire\Admin\Contratos;

use Livewire\Component;
use App\Models\Checkin;

class CheckComponent extends Component
{
    public $check = [];
    public $table;

    public function mount($table)
    {
        $this->table = $table;
        $this->check = [isset($table->check) ? false : true];
    }
    public function render()
    {
        return view('livewire.admin.contratos.check.check-component');
    }
    public function updatedCheck($value)
    {
        //dd($value,isset($this->check),isset($value));
        Checkin::find($this->table->id)->fill([
            'check'=> $value === [] || $value === true ? true : false,
        ])->save();
    }
}

