<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 // Page index
 Route::get('/', 'AlunoController@index');

/**
 * Aluno
 */
Route::prefix('alunos')->group(function () {
    // Page index
    Route::get('/', 'AlunoController@index');

    // Page create
    Route::get('/create', 'AlunoController@create');

    // Page edit
    Route::get('/edit/{id}', 'AlunoController@edit');

    // Page delete
    Route::get('/delete/{id}', 'AlunoController@delete');

    // Insert aluno
    Route::post('/store', 'AlunoController@store')->name('registrar_aluno');

    // Busca na tabela aluno
    Route::get('/show', 'AlunoController@show');

    // Busca na tabela aluno
    Route::get('/show/{id}', 'AlunoController@showById');

    // Update aluno
    Route::post('/update', 'AlunoController@update')->name('atualizar_aluno');

    // Delete aluno
    Route::post('/destroy', 'AlunoController@destroy')->name('deletar_aluno');
});

/**
 * Cursos
 */
Route::prefix('cursos')->group(function () {
    // Page index
    Route::get('/', 'CursoController@index');

    // Page create
    Route::get('/create', 'CursoController@create');

    // Page edit
    Route::get('/edit/{id}', 'CursoController@edit');

    // Page delete
    Route::get('/delete/{id}', 'CursoController@delete');

    // Insert curso
    Route::post('/store', 'CursoController@store')->name('registrar_curso');

    // Busca na tabela curso
    Route::get('/show', 'CursoController@show');

    // Busca na tabela curso
    Route::get('/show/{id}', 'CursoController@showById');

    // Update curso
    Route::post('/update', 'CursoController@update')->name('atualizar_curso');

    // Delete curso
    Route::post('/destroy', 'CursoController@destroy')->name('deletar_curso');
});

/**
 * CursosAlunos
 */
Route::prefix('curso_aluno')->group(function () {
    // Page index
    Route::get('/{id}', 'CursoAlunoController@index');

    // Insert cursoaluno
    Route::post('/store', 'CursoAlunoController@store')->name('registrar_cursoaluno');

    // Delete cursoaluno
    Route::post('/destroy', 'CursoAlunoController@destroy')->name('deletar_cursoaluno');
});

/**
 * PDF
 */
Route::get('/pdf_new/{view}/{data}/{name_archive}', 'PdfviewController@newPdf');
