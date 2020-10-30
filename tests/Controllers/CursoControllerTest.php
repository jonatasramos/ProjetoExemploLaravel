<?php

namespace Tests\Controllers;

use Tests\TestCase;

/**
 * Class CursoTest
 * 
 * @author Jônatas Ramos
 */

class CursoTest extends TestCase
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
     * Verifica o carregamento da página inicial dos cursos
     */
    public function testVerifyPageIndexCurso()
    {
        $response = $this->get("{$this->url}/cursos");
        $response->assertStatus(200);
    }

    /**
     * Verifica o carregamento da página inicial dos cursos
     */
    public function testVerifyPageCreateCurso()
    {
        $response = $this->get("{$this->url}/cursos/create");
        $response->assertStatus(200);
    }

    /**
     * Verifica o carregamento da página de edição dos cursos
     */
    public function testVerifyPageEditCurso()
    {
        $id = 1;
        $response = $this->get("{$this->url}/cursos/edit/{$id}");
        $response->assertStatus(200);
    }

    /**
     * Verifica o carregamento da página para deletar os cursos
     */
    public function testVerifyPageDeleteCurso()
    {
        $id = 1;
        $response = $this->get("{$this->url}/cursos/edit/{$id}");
        $response->assertStatus(200);
    }

    /**
     * Teste de Inserção na tabela curso
     */
    public function testStoreInCurso()
    {
        $data = [
            'nome' => 'Laravel 7',
            'carga_horaria' => rand(10,1000)
        ];

        $response = $this->post("{$this->url}/cursos/store", $data);
        $response->assertStatus(302);
        $response->assertRedirect('cursos');
    }

    /**
     * Teste de busca de todos os cursos
     */
    public function testFindInTableCurso()
    {
        $response = $this->get("{$this->url}/cursos/show");
        $response->assertJsonStructure([
            'cursos' => [
                [
                    'cur_id',
                    'cur_nome',
                    'cur_carga_horaria',
                    'cur_data_cadastro',
                    'cur_data_atualizado'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Teste de busca de apenas um Curso
     */
    public function testFindOneItemInTableCurso()
    {
        $id = 1;
        $response = $this->get("{$this->url}/cursos/show/{$id}");
        $response->assertJsonStructure([
            'cur_id',
            'cur_nome',
            'cur_carga_horaria',
            'cur_data_cadastro',
            'cur_data_atualizado'
        ]);
        $response->assertStatus(200);
    }

    /**
     * Teste de update na tabela Curso
     */
    public function testUpdateInCurso()
    {
        $data = [
            'id' => 1,
            'nome' => 'Curso Teste 2',
            'carga_horaria' => rand(10,100)
        ];

        $response = $this->post("{$this->url}/cursos/update", $data);
        $response->assertStatus(302);
        $response->assertRedirect('cursos');
    }

    /**
     * Teste de delete na tabela Curso
     */
    public function testDestroyInCurso()
    {
        $data = [
            'id' => 1
        ];

        $response = $this->post("{$this->url}/cursos/destroy", $data);
        $response->assertStatus(302);
        $response->assertRedirect('cursos');
    }
}
