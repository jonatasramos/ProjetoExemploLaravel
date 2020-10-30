@include('includes.header')
<?php
getSuccess();
getError();
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="mb-3">Atualizar Curso</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('atualizar_curso') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome" value="{{ $cur_nome }}"><br>
                
                <label for="carga_horaria">Carga Horária</label>
                <input type="text" name="carga_horaria" class="form-control" id="carga_horaria" value="{{ $cur_carga_horaria }}">
                <input type="hidden" name="id" value="{{ $cur_id }}">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@include('includes.footer')
