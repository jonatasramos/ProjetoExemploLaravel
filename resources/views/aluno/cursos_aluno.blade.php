@include('includes.header')
<?php
getSuccess();
getError();
?>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h2 class="mb-3">Cursos do Aluno: <b>{{ $aluno->alu_nome }}</b> </h2>
        <form action="{{ route('registrar_cursoaluno') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="nome">Vincular Novo Curso</label><br>
                <input type="hidden" name="id_aluno" value="{{ $aluno->alu_id }}">
                <select class="form-group" name="id_curso" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso['cur_id'] }}">
                            {{ $curso['cur_nome'] }} - Carga Horária: {{ $curso['cur_carga_horaria'] }}hrs
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        <hr>
        <br>
        <h3><strong>Cursos Cadastrados</strong></h3>
        <table class="table col-md-12">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do Curso</th>
                    <th scope="col">Carga Horária</th>
                    <th scope="col">Acão</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cursos_aluno as $curso_aluno)
                    <tr>
                        <th scope="row">{{ $curso_aluno->cal_id }}</th>
                        <td>{{ $curso_aluno->cur_nome }}</td>
                        <td>{{ $curso_aluno->cur_carga_horaria }}</td>
                        <td>
                            <form action="{{ route('deletar_cursoaluno') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $curso_aluno->cal_id }}" name="id">
                                <button type="submit" class="btn btn-smal btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <?php $data = [
                                'id' => $curso_aluno->cal_id,
                                'nome_aluno' => $aluno->alu_nome,
                                'nome_curso' => $curso_aluno->cur_nome,
                                'carga_horaria' => $curso_aluno->cur_carga_horaria,
                                ]; ?>
                                <a class="btn btn-smal btn-info"
                                    href="/pdf_new/certificate/{{ serialize($data) }}/certificado.pdf">
                                    <i class="fas fa-print"></i>
                                </a>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('includes.footer')
