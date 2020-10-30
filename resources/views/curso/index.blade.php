@include('includes.header')
<?php
getSuccess();
getError();
?>
<h2>Tabela de Cursos</h2>
<a href="/cursos/create">
    <button class="btn btn-info mb-2" style="float: right;">
        <i class="far fa-plus-square"></i>
        &nbsp; Novo Curso
    </button>
</a>

<table class="table col-md-12">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Carga Horária</th>
            <th scope="col">Data/Cadastro</th>
            <th scope="col">Data/Atualização</th>
            <th scope="col">Acão</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cursos as $curso)
            <tr>
                <th scope="row">{{ $curso->cur_id }}</th>
                <td>{{ $curso->cur_nome }}</td>
                <td>{{ $curso->cur_carga_horaria }}hrs</td>
                <td>{{ formatDate($curso->cur_data_cadastro) }}</td>
                <td>{{ formatDateTime($curso->cur_data_atualizado) }}</td>
                <td>
                    <a class="btn btn-smal btn-info" href="/cursos/edit/{{ $curso->cur_id }}">
                        <i class="fas fa-pen-square"></i>
                    </a>
                    <a class="btn btn-smal btn-danger" href="/cursos/delete/{{ $curso->cur_id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('includes.footer')
