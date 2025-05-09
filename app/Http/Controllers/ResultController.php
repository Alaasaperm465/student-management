<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\App as FacadesApp;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function report1($pid){
        $payment = Payment::find($pid);
        $pdf = FacadesApp::make('dompdf.wrapper');
        $print = "<div style='margin:20px; padding:20px;'>";
        $print.= "<h1 align ='center'>payment report</h1>";
        $print.= "<hr/>";
        $print.="<p> Recipt No : <b>". $pid . "</b> </p>";
        $print.="<p> Date : <b>" . $payment->paid_date ."</b></p>";
        $print.="<p> Enroll No : <b>" . $payment->enrollment->name . "</b></p>";
        $print.= "<p> Student Name : <b>" . $payment->enrollment->student->name ."</b></p>";
        $print .="<hr/>";
        $print .="<table style='width: 100%'>";

        $print .= "<tr>";
        $print .= "<td>Description</td>";
        $print .= "<td>Amount</td>";
        $print .= "</tr>";

        $print .= "<tr>";
        $print .= "<td><h3>" . $payment->enrollment->batch->name . "</h3></td>";
        $print .= "<td><h3>" . $payment->amount . "</h3></td>";
        $print .= "</tr>";
        $print .="</table>";
        $print .="<hr/>";

        $print .= "<span> Printed By : <b> </b></span>";
        $print .= "<span> Printed Date : <b>" . date('Y m d'). "</b></span>";

        $print .= "</div>";

        $pdf->loadHTML($print);
        return $pdf->stream();
    } 
    public function report2($pid){
        $payment = Payment::find($pid);
        $pdf = FacadesApp::make('dompdf.wrapper');
        echo "<div style='margin:20px; padding:20px;'><h1 align ='center'>payment report</h1><hr/>";
        echo "<p> Student Name : <b>" . $payment->enrollment->student->name ."</b></p><p> Serial Number : <b>". $pid . "</b> </p><p> Enroll Number : <b>" . $payment->enrollment->name . "</b></p><p> Date : <b>" . $payment->paid_date ."</b></p>";
        echo "<hr/><table style='width: 100%'>";
        echo "<tr><td>Description</td><td>Amount</td></tr><tr>";
        echo "<td><h3>" . $payment->enrollment->batch->name . "</h3></td><td><h3>" . $payment->amount . "</h3></td>";
        echo "</tr></table><hr/><span> Printed Date : <b>" . date('D d - m - Y'). "</b></span></div>";


    } 
}
