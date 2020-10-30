<?php

namespace Tests\Controllers;

use Tests\TestCase;

/**
 * Class AlunoTest
 * 
 * @author Jônatas Ramos
 */

class AlunoTest extends TestCase
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
     * Verifica o carregamento da página inicial dos alunos
     */
    public function testVerifyPageIndexAluno()
    {
        $response = $this->get("{$this->url}/alunos");
        $response->assertStatus(200);
    }

    /**
     * Verifica o carregamento da página inicial dos alunos
     */
    public function testVerifyPageCreateAluno()
    {
        $response = $this->get("{$this->url}/alunos/create");
        $response->assertStatus(200);
    }

    /**
     * Verifica o carregamento da página de edição dos alunos
     */
    public function testVerifyPageEditAluno()
    {
        $id = 1;
        $response = $this->get("{$this->url}/alunos/edit/{$id}");
        $response->assertStatus(200);
    }

    /**
     * Verifica o carregamento da página para deletar os alunos
     */
    public function testVerifyPageDeleteAluno()
    {
        $id = 1;
        $response = $this->get("{$this->url}/alunos/edit/{$id}");
        $response->assertStatus(200);
    }

    /**
     * Teste de Inserção na tabela aluno
     */
    public function testStoreInAluno()
    {
        $data = [
            'nome' => 'Aluno Teste'
        ];

        $response = $this->post("{$this->url}/alunos/store", $data);
        $response->assertStatus(302);
        $response->assertRedirect('alunos');
    }

    /**
     * Teste de busca de todos os alunos
     */
    public function testFindInTableAluno()
    {
        $response = $this->get("{$this->url}/alunos/show");
        $response->assertJsonStructure([
            'alunos' => [
                [
                    'alu_id',
                    'alu_nome',
                    'alu_data_cadastro',
                    'alu_data_atualizado'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Teste de busca de apenas um aluno
     */
    public function testFindOneItemInTableAluno()
    {
        $id = 1;
        $response = $this->get("{$this->url}/alunos/show/{$id}");
        $response->assertJsonStructure([
            'alu_id',
            'alu_nome',
            'alu_data_cadastro',
            'alu_data_atualizado'
        ]);
        $response->assertStatus(200);
    }

    /**
     * Teste de update na tabela aluno
     */
    public function testUpdateInAluno()
    {
        $data = [
            'id' => 1,
            'nome' => 'Aluno Teste 2'
        ];

        $response = $this->post("{$this->url}/alunos/update", $data);
        $response->assertStatus(302);
        $response->assertRedirect('alunos');
    }

    /**
     * Teste de delete na tabela aluno
     */
    public function testDestroyInAluno()
    {
        $data = [
            'id' => 1
        ];

        $response = $this->post("{$this->url}/alunos/destroy", $data);
        $response->assertStatus(302);
        $response->assertRedirect('alunos');
    }
}
