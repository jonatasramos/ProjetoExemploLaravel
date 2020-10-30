<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CursoAluno;
use App\Models\Curso;

/**
 * Class CursoController
 * 
 * @author Jônatas Ramos
 */

class CursoController extends Controller
{
    /**
     * Instância de Curso
     * 
     * @var Object - $Curso
     */
    protected $Curso;

    /**
     * Instância de CursoAluno
     * 
     * @var Object - $CursoAluno
     */
    protected $CursoAluno;

    /** @method __construct */
    public function __construct()
    {
        $this->Curso = new Curso();
        $this->CursoAluno = new CursoAluno();
    }

    /**
     * Carrega a página de cursos
     * 
     */
    public function index()
    {
        $cursos = $this->show();
        return view('curso.index', $cursos);
    }

    /**
     * Carrega a página para criar cursos
     * 
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Carrega a página para atualizar cursos
     * 
     * @param Number - $id 
     */
    public function edit($id)
    {
        $curso = $this->showById($id);
        return view('curso.edit', $curso);
    }

    /**
     * Carrega a página para deletar cursos
     * 
     * @param Number - $id 
     */
    public function delete($id)
    {
        $curso = $this->showById($id);
        return view('curso.delete', $curso);
    }

    /**
     * CRUD tabela curso 
     */

    /**
     * Busca todos os cursos no banco de dados
     * 
     * @return Array - $response
     */
    public function show()
    {
        $response = [];
        try {
            $cursos = $this->Curso->get();
            $response['cursos'] = $cursos;
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao listar os cursos!');
        }
        return $response;
    }

    /**
     * Busca um curso por id no banco de dados
     * 
     * @param Number - $id
     * @return Array - $response
     */
    public function showById($id)
    {
        $response = [];
        try {
            $curso = $this->Curso->find($id);
            $response = $curso;
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao listar o curso!');
        }
        return $response;
    }

    /**
     * Insert na tabela curso
     * 
     * @param Request - $request
     * @return Boolean
     */
    public function store(Request $request)
    {
        $customMessages = [
            'nome.required' => 'Preencha o campo Nome corretamente.',
            'carga_horaria.required' => 'Preencha o campo Carga Horária corretamente',
            'nome.min' => 'Minímo 3 caracteres para o Nome'
        ];

        $rules = array(
            'nome' => 'required|min:3',
            'carga_horaria' => 'required'
        );

        $this->validate($request, $rules, $customMessages);
        try {
            $data = [
                'cur_nome' => $request->nome,
                'cur_carga_horaria' => $request->carga_horaria,
                'cur_data_cadastro' => date('Y-m-d')
            ];

            if ($this->Curso->insert($data)) {
                setSuccess('Curso cadastrado com sucesso!');
                return redirect('/cursos');
            } else {
                setError('Ocorreu um erro ao tentar cadastrar o curso!');
                return redirect('/cursos/create');
            }
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao tentar cadastrar o curso!');
            return redirect('/cursos/create');
        }
    }

    /**
     * Update na tabela curso
     * 
     * @param Request - $request
     * @return Boolean
     */
    public function update(Request $request)
    {
        $customMessages = [
            'nome.required' => 'Preencha o campo Nome corretamente.',
            'carga_horaria.required' => 'Preencha o campo Carga Horária corretamente',
            'nome.min' => 'Minímo 3 caracteres para o Nome'
        ];

        $rules = array(
            'nome' => 'required|min:3',
            'carga_horaria' => 'required'
        );

        $this->validate($request, $rules, $customMessages);

        try {
            $data = [
                'cur_nome' => $request->nome,
                'cur_carga_horaria' => $request->carga_horaria
            ];

            $this->Curso->where('cur_id', $request->id)->update($data);
            setSuccess('Curso atualizado com sucesso!');
            return redirect('/cursos');
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao tentar atualizar o Curso!');
            return redirect('/cursos/edit/' . $request->id);
        }
    }

    /**
     * Delete na tabela curso
     * 
     * @param Request - $request
     * @return Boolean
     */
    public function destroy(Request $request)
    {
        $customMessages = [
            'required' => 'Requisição Inválida.',
        ];

        $rules = array(
            'id' => 'required',
        );

        $this->validate($request, $rules, $customMessages);

        $qtd_cursoaluno = $this->CursoAluno
        ->where('cal_id_curso', $request->id)
        ->count();

        if ($qtd_cursoaluno == 0) {
            try {
                setSuccess('Curso deletado com sucesso!');
                return redirect('/cursos');
            } catch (\Throwable $th) {
                setError('Ocorreu um erro ao tentar deletar o Curso!');
                return redirect('/cursos/delete/' . $request->id);
            }
        } else {
            setError('Não foi possível deletar ese curso, pois ele está vinculado a um aluno!');
            return redirect('/cursos/delete/' . $request->id);
        }
    }
}
