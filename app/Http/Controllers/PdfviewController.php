<?php namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;

class PdfviewController extends Controller
{
    /**
     * Caminho da pasta view dos pdfs
     * 
     * @var String - $url_folder
     */
    public $url_folder = 'pdf.';

    public function newPdf($view, $data, $name_archive) {
        return PDF::loadView($this->url_folder.$view, unserialize($data))
        ->setPaper('a4', 'landscape')
        ->download($name_archive);
    }
}