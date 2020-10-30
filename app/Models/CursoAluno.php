<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoAluno extends Model
{
    public $primaryKey = 'cal_id';
    public $table = 'curso_aluno';
    public $fillable = ['cal_id_aluno', 'cal_id_curso'];
    public $timestamps = false;
}