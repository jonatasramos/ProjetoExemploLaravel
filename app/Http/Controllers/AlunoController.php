<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\CursoAluno;

/**
 * Class AlunoController
 * 
 * @author Jônatas Ramos
 */

class AlunoController extends Controller
{
    /**
     * Instância de Aluno
     * 
     * @var Object - $Aluno
     */
    protected $Aluno;

    /**
     * Instância de CursoAluno
     * 
     * @var Object - $CursoAluno
     */
    protected $CursoAluno;

    /** @method __construct */
    public function __construct()
    {
        $this->Aluno = new Aluno();
        $this->CursoAluno = new CursoAluno();
    }

    /**
     * Carrega a página de alunos
     * 
     */
    public function index()
    {
        $alunos = $this->show();
        return view('aluno.index', $alunos);
    }

    /**
     * Carrega a página para criar alunos
     * 
     */
    public function create()
    {
        return view('aluno.create');
    }

    /**
     * Carrega a página para atualizar alunos
     * 
     * @param Number - $id 
     */
    public function edit($id)
    {
        $aluno = $this->showById($id);
        return view('aluno.edit', $aluno);
    }

    /**
     * Carrega a página para deletar alunos
     * 
     * @param Number - $id 
     */
    public function delete($id)
    {
        $aluno = $this->showById($id);
        return view('aluno.delete', $aluno);
    }


    /**
     * Busca um aluno por id no banco de dados
     * 
     * @param Number - $id
     * @return Array - $response
     */
    public function showById($id)
    {
        $response = [];
        try {
            $aluno = $this->Aluno->find($id);
            $response = $aluno;
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao listar os Alunos!');
        }
        return $response;
    }


    /**
     * CRUD tabela aluno 
     */

    /**
     * Busca todos os alunos no banco de dados
     * 
     * @return Array - $response
     */
    public function show()
    {
        $response = [];
        try {
            $alunos = $this->Aluno->orderBy('alu_id', 'DESC')->get();
            $response['alunos'] = $alunos;
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao listar os Alunos!');
        }
        return $response;
    }

    /**
     * Insert na tabela aluno
     * 
     * @param Request - $request
     * @return Boolean
     */
    public function store(Request $request)
    {
        $customMessages = [
            'required' => 'Preencha o nome corretamente.',
            'min' => 'Minímo 3 caracteres para o nome'
        ];

        $rules = array(
            'nome' => 'required|min:3',
        );

        $this->validate($request, $rules, $customMessages);

        try {
            $data = [
                'alu_nome' => $request->nome,
                'alu_data_cadastro' => date('Y-m-d')
            ];

            if ($this->Aluno->insert($data)) {
                setSuccess('Aluno cadastrado com sucesso!');
                return redirect('/alunos');
            } else {
                setError('Ocorreu um erro ao tentar cadastrar o Aluno!');
                return redirect('/alunos/create');
            }
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao tentar cadastrar o Aluno!');
            return redirect('/alunos/create');
        }
    }

    /**
     * Update na tabela aluno
     * 
     * @param Request - $request
     * @return Boolean
     */
    public function update(Request $request)
    {
        $customMessages = [
            'required' => 'Preencha o nome corretamente.',
            'min' => 'Minímo 3 caracteres para o nome'
        ];

        $rules = array(
            'nome' => 'required|min:3',
        );

        $this->validate($request, $rules, $customMessages);

        try {
            $data = [
                'alu_nome' => $request->nome,
            ];

            $this->Aluno->where('alu_id', $request->id)->update($data);
            setSuccess('Aluno atualizado com sucesso!');
            return redirect('/alunos');
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao tentar atualizar o Aluno!');
            return redirect('/alunos/edit/' . $request->id);
        }
    }

    /**
     * Delete na tabela aluno
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
        try {
            $this->CursoAluno->where('cal_id_aluno', $request->id)->delete();
            $this->Aluno->where('alu_id', $request->id)->delete();
            
            setSuccess('Aluno deletado com sucesso!');
            return redirect('/alunos');
        } catch (\Throwable $th) {
            setError('Ocorreu um erro ao tentar deletar o Aluno!');
            return redirect('/alunos/delete/' . $request->id);
        }
    }
}
