<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $table = 'systems';
    protected $fillable = ['name','email','cpf','numero'];

    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'cpf' => 'required|string|max:14|unique:users,cpf',
        'numero' => 'required|string|max:15',
        
    ];
}
