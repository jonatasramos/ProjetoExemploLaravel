<?php

/**
 * Funções auxiliares do sistema
 * 
 * @author Jônatas Ramos
 */

/**
 * Grava uma mensagem de sucesso
 */
function setSuccess($msg)
{
    session(['success' => $msg]);
}

/**
 * Retorna a mensagem de sucesso gravada em setSuccess
 * 
 */
function getSuccess()
{
    $msg = session('success');
    if (!empty($msg)) {
        echo
            "<div class='alert alert-success mb-0 mt-4' role='alert'>
                 <strong>{$msg}</strong>
            </div>";
        unsetSession('success');
    }
}

/**
 * Grava uma mensagem de erro
 */
function setError($msg)
{
    session(['error' => $msg]);
}

/**
 * Retorna a mensagem de error gravada em setError
 * 
 */
function getError()
{
    $msg = session('error');
    if (!empty($msg)) {
        echo
            "<div class='alert alert-danger mb-0 mt-4' role='alert'>
                 <strong>{$msg}</strong>
            </div>";
        unsetSession('error');
    }
}

/**
 * Limpa um item da sessão
 * 
 */
function unsetSession($session)
{
    session()->forget([$session]);
}

/**
 * Formata data
 * 
 */
function formatDate($date)
{
    return date('d/m/Y', strtotime($date));
}

/**
 * Formata Data com hora
 * 
 */
function formatDateTime($datetime)
{
    return date('d/m/Y H:i:s', strtotime($datetime));
}
