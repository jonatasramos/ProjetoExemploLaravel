@include('includes.header')
<?php
getSuccess();
getError();
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="mb-3">Novo Aluno</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('registrar_aluno') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@include('includes.footer')
