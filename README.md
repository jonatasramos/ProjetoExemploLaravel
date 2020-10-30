Laravel CRUD
=============

Página web com CRUD de alunos e cursos

 - Para realizar o bakend projeto foi utilizado o Framework Laravel seguindo 
 os padrões MVC.

 - A linguagem utilizada para a manipulação do banco de dados foi SQL,
 as instruções para a execução do mesmo estarão abaixo.

- Utilizei laravel-dompdf para gerar o pdf.

## Executando o Projeto

 - Primeiramente execute:

```bash
composer install
```
 - Na raiz do projeto é possivel encontrar a pasta DB, nela contên o arquivo
 laravel_curso.sql contêndo o sql do banco de dados, no projeto foi utilizado
 este nome laravel_curso para o banco de dados, certifique-se que antes de 
 importar o arquivo .sql o banco já esteja criado.

## Executando os Testes
 
 - Peço que antes de rodar os testes certifique-se dos registros no banco de dados.
 
 - Para a construção dos testes foi utilizado o Framework PHPUnit, para executá-lo
 execute na raiz do projeto no terminal:

```bash
composer run-script test
```

Ou

```bash
vendor/bin/phpunit --testdox
```

Obs: Para não interfirir na integridade dos registros do banco de dados e interferir nos
testes da aplicação em si, os testes dos Models onde contêm atualização estão atualizando
os registros já existentes com os mesmos valores, e os testes de delete estão tentando deletar
registros inexistentes por default, caso necessário apenas altere para excluir um registro que exista no banco de dados.






