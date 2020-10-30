@include('includes.header')
<?php
getSuccess();
getError();
?>
<h2>Tabela de Alunos</h2>
<a href="/alunos/create">
    <button class="btn btn-info mb-2" style="float: right;">
        <i class="far fa-plus-square"></i>
        &nbsp; Novo Aluno
    </button>
</a>

<table class="table col-md-12">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Data/Cadastro</th>
            <th scope="col">Data/Atualização</th>
            <th scope="col">Acão</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alunos as $aluno)
            <tr>
                <th scope="row">{{ $aluno->alu_id }}</th>
                <td>{{ $aluno->alu_nome }}</td>
                <td>{{ formatDate($aluno->alu_data_cadastro) }}</td>
                <td>{{ formatDateTime($aluno->alu_data_atualizado) }}</td>
                <td>
                    <a class="btn btn-smal btn-info" href="/alunos/edit/{{ $aluno->alu_id }}">
                        <i class="fas fa-pen-square"></i>
                    </a>
                    <a class="btn btn-smal btn-danger" href="/alunos/delete/{{ $aluno->alu_id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a class="btn btn-smal btn-success" href="/curso_aluno/{{ $aluno->alu_id }}">
                        Ver cursos
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('includes.footer')
