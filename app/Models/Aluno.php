<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public $primaryKey = 'alu_id';
    public $table = 'aluno';
    public $fillable = ['alu_nome', 'alu_data_cadastro', 'alu_data_atualizado'];
    public $timestamps = false;
}
