<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $table = 'filters';
    protected $fillable = ['name','color'];

    public $rules = [
        'name' => 'required|string|max:255',
        'color' => 'required|string|max:255',

    ];
}
