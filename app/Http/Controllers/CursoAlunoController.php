<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CursoAluno;
use App\Models\Aluno;
use App\Models\Curso;


/**
 * Class CursoAluno
 * 
 * @author Jônatas Ramos
 */

class CursoAlunoController extends Controller
{
    /**
     * Instância de CursoAluno
     * 
     * @var Object - $CursoAluno
     */
    protected $CursoAluno;

    /**
     * Instância de Aluno
     * 
     * @var Object - $Aluno
     */
    protected $Aluno;

    /**
     * Instância de Curso
     * 
     * @var Object - $Curso
     */
    protected $Curso;

    /** @method __construct */
    public function __construct()
    {
        $this->CursoAluno = new CursoAluno();
        $this->Aluno = new Aluno();
        $this->Curso = new Curso();
    }

    /**
     * Exibe a tela com os cursos do aluno
     * 
     * @param Number - $id
     */
    public function index($id)
    {
        $cursos_aluno = $this->show($id);
        $aluno = $this->Aluno->find($id);
        $cursos = $this->Curso->get();

        $data = [
            'cursos' => $cursos,
            'aluno' => $aluno,
            'cursos_aluno' => $cursos_aluno
        ];

        return view('aluno.cursos_aluno', $data);
    }

    /**
     * Seleciona um curso de um aluno
     * 
     * @param Number - $id_aluno
     * @param Number - $id_curso
     */
    public function findByCursoAluno($id_aluno, $id_curso)
    {
        $curso_aluno = $this->CursoAluno
            ->where('cal_id_aluno', $id_aluno)
            ->where('cal_id_curso', $id_curso)
            ->get();

        return $curso_aluno;
    }

    /**
     * CRUD tabela curso_aluno
     */

    /**
     * Atribui um novo curso ao aluno
     * 
     * @param Request - $request
     */
    public function store(Request $request)
    {
        $curso_aluno = $this->findByCursoAluno($request->id_aluno, $request->id_curso);
        
        if (!isset($curso_aluno[0]->cal_id_aluno)) {
            try {
                $data = [
                    'cal_id_aluno' => $request->id_aluno,
                    'cal_id_curso' => $request->id_curso,
                ];

                if ($this->CursoAluno->insert($data)) {
                    setSuccess('Curso vinculado com sucesso!');
                } else {
                    setError('Ocorreu um erro ao tentar vincular o curso!');
                }
            } catch (\Throwable $th) {
                setError('Ocorreu um erro ao tentar vincular o curso!');
                return back()->withInput();
            }
            return redirect("/curso_aluno/{$request->id_aluno}");
        } else {
            setError('Curso já cadastrado!');
            return back()->withInput();
        }
    }

    /**
     * Pega os cursos do aluno por id de aluno
     * 
     * @param Number - $id
     */
    public function show($id)
    {
        $cursos_aluno = $this->CursoAluno
            ->join('curso', 'cal_id_curso', '=', 'cur_id')
            ->where('cal_id_aluno', $id)
            ->get();

        return $cursos_aluno;
    }

    /**
     * Remove um cuso do aluno
     * 
     * @param Request - $request
     */
    public function destroy(Request $request)
    {
        try {
            $this->CursoAluno->where('cal_id', $request->id)->delete();
            setSuccess('Curso removido com sucesso');
        } catch (\Throwable $th) {
            setSuccess('Erro ao remover o curso!');
        }
        return back()->withInput();
    }
}
