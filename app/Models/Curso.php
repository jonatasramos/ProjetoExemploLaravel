<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $primaryKey = 'cur_id';
    public $table = 'curso';
    public $fillable = ['cur_nome', 'cur_carga_horari', 'cur_data_cadastro', 'cur_data_atualizado'];
    public $timestamps = false;
}
