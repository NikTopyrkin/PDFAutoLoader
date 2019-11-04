<?php
/*
Author: Nik Topyrkin;
Version: 1.0;
This is program for auto generation pdf-document.
Our invoice-document to pdf.
This program is under development, stay tuned
*/
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

    function __construct() {

        require_once 'tcpdf.php';

    }


    public function index(){

        $title = 'Счет на оплату';
        $invoice = $this->readDocument();
        $this->pdfAutoLoader($invoice, $title);

    }

    public function readDocument(){

        $file = file_get_contents('invoice.html', true);

        return $file;

    }



    public function pdfAutoLoader($invoice, $title){

            //Our PDF Documanet
 
            ob_start();
            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
            $pdf->SetFont('dejavusans', '', 7, '', true);
            $pdf->SetAuthor('NikTopyrkin');
            $pdf->SetTitle($title);
            $pdf->SetKeywords($title);
            $pdf->SetTextColor(15,15,15);
            $pdf->AddPage('L');
            $pdf->SetDisplayMode('real','default');
            $pdf->SetDrawColor(50,60,100);
            $pdf->SetFontSize(7);
            $pdf->WriteHTML($invoice);
            ob_end_clean();
            $pdf->Output($title,'I');

    }

    }

?>