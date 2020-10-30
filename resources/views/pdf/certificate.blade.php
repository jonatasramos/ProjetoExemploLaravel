<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Certificado Digital</title>

    <!--Custon CSS-->
    <link rel="stylesheet" href="{{ public_path('assets/css/certificate.css') }}">
</head>

<body>
    <div class="certificado">
        <div class="conteudo-certificado text-center">
            <h1 class="titulo-certificado"><i>CERTIFICADO</i></h1>

            <h2 class="detalhes-certificado">
                Certificamos que <span class="nome-aluno">{{ $nome_aluno }}</span> concluiu o <br>
                Curso <span class="curso">Curso {{ $nome_curso }} </span> com carga horária total de
                {{ $carga_horaria }} horas.
            </h2>

            <h3 class="mais-detalhes-certificado">
                Certificado nº <b>{{ $id }}</b> para verificar se é um certificado válido:
                site.com.br/verificar-certificado
            </h3>
        </div>

    </div>
    <!--Certificado-->

</body>

</html>
