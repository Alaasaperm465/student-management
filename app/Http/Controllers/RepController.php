<?php

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\App as FacadesApp;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class RepController extends Controller
{

    public function report1($pid){
        $payment = Payment::find($pid);
        $pdf = FacadesApp::make('dompdf.wrapper');
        $print = "<div style='margin:20px; padding:20px;'>";
        $print.= "<h1 align ='center'>payment report</h1>";
        $print.= "<hr/>";
        $print.="<p> REcipt No : <b>". $pid . "</b> </p>";
        $print.="<p> Date : <b>" . $payment->paid_date ."</b></p>";
        $print.="<p> Enroll No : <b>" . $payment->enrollment->name . "</b></p>";
        $print.= "<p> Student Name : <b>" . $payment->enrollment->student->name ."</b></p>";
        $print .="<hr/>";
        $print .="<table style='width: 100%'>";

        $print .= "<tr>";
        $print .= "<td>Description</td>";
        $print .= "<td>ِAmount</td>";
        $print .= "</tr>";

        $print .= "<tr>";
        $print .= "<td><h3>" . $payment->enrollment->batch->name . "</h3></td>";
        $print .= "<td><h3>" . $payment->amount . "</h3></td>";
        $print .= "</tr>";
        $print .="</table>";
        $print .="<hr/>";

        $print .= "<span> Printed By : <b>" . FacadesAuth::user()->name . "</b></span>";
        $print .= "<span> Printed Date : <b>" . date('Y m d'). "</b></span>";

        $print -= "</div>";

        $pdf->loadHTML($print);
        return $pdf->stream();
    } 
}


?>






















































/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $data = [
            'title'=>'report of student',
            'name'=>'alaa',
            'number'=>7000,
        ];

        // تحميل عرض (view) وتوليد PDF
        $pdf = Pdf::loadView('pdf.report', $data);

        // تحميل الملف مباشرة
        //return $pdf->download('report.pdf');

        // أو عرضه في المتصفح
        // return $pdf->stream('report.pdf');
    }
}
*/