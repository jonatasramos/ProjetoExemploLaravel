<?php

namespace Tests\Controllers;

use Tests\TestCase;

/**
 * Class AlunoTest
 * 
 * @author Jônatas Ramos
 */

class CursoAlunoTest extends TestCase
{
    /**
     * Url da requisição
     * 
     * @var String - $url
     */
    public $url = 'http://localhost:8000';

    /** @method setUp */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Verifica o carregamento da página inicial dos cursos do aluno
     */
    public function testVerifyPageIndexAlunoCursos()
    {
        $id = 8;
        $response = $this->get("{$this->url}/curso_aluno/{$id}");
        $response->assertStatus(200);
    }

    /**
     * Teste de Inserção na tabela curso_aluno
     */
    public function testStoreInCursoAluno()
    {
        $data = [
            'id_aluno' => 1,
            'id_curso' => 1
        ];

        $response = $this->post("{$this->url}/curso_aluno/store", $data);
        $response->assertStatus(302);
        $response->assertRedirect("/curso_aluno/{$data['id_aluno']}");
    }

    /**
     * Teste de delete na tablea curso_aluno
     */
    public function testDestroyInCursoAluno()
    {
        $data = [
            'id' => 1
        ];

        $response = $this->post("{$this->url}/curso_aluno/destroy", $data);
        $response->assertStatus(302);
    }
}
