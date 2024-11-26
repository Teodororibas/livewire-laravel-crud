<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $table = 'checkins';
    protected $fillable = ['title','description', 'data_list', 'ordem', 'prioridade', 'icone','check','time_inicial','time_final','data_final'];

    public $rules = [
        'title' => 'required|string|max:255',
        'data_list' => 'required|date',
        'data_final' => 'required|date',
        'description' => 'required|string|max:255',
        'time_inicial' => 'nullable|date_format:H:i',
        'time_final' => 'nullable|date_format:H:i',
        'ordem' => 'required|integer',
        'prioridade' => 'required|integer',
        'icone' => 'required|string|max:255',
        'check' => 'nullable|boolean'

    ];
}
