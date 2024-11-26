<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'logins';
    protected $fillable = ['name','password'];

    public $rules = [
        'name' => 'required|string|max:255',
        'password' => 'required|string|max:255',

    ];

}
