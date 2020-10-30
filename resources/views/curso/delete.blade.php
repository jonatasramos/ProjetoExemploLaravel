@include('includes.header')
<?php
getSuccess();
getError();
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="mb-3">Deletar Curso</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('deletar_curso') }}" method="POST">
            @csrf
            <div class="form-group" style="text-align: center;">
                <label for="nome">Deseja realmente deletar o curso <b>{{$cur_nome}}</b></label>
                <input type="hidden" name="id" value="{{ $cur_id }}">
            </div>
            <button type="submit" class="btn btn-success">Sim</button>
            <a href="/cursos" style="color: #fff; float: right;" type="submit" class="btn btn-danger">Não</a>
        </form>
    </div>
</div>
@include('includes.footer')
