<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Payment;
use App\Models\Enrollments;

class PaymentController extends Controller
{
    public function index():view
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
        
    }
    public function create():View
    {
        $enrollments = Enrollments::pluck( 'name','id');
        return view('payments.create')->with('enrollments' , $enrollments);
    }
    public function store(Request $request)
    {
        $x = $request->all();
        Payment::create($x);
        return redirect('payments')->with('flash messamge' , 'Payment ADED');
    }
    public function show(string $id)
    {
        $payments = Payment::findOrFail($id);
        return view('payments.show')->with('payments' , $payments);
    }
    public function edit(string $id)
    {
        $payments = Payment::findOrFail($id);
        $enrollments = Enrollments::pluck('name' , 'id');
        return view('payments.edite' , compact('payments','enrollments'));
    }
    public function update(Request $request, string $id)
    {
        $payments = payment::findOrFail($id);
        $payments->update($request->only(['enrollment_id', 'paid_date', 'amount']));
        return redirect()->route('payments.index', $id)->with('success', 'Payment updated successfully!');
    }
    public function destroy(string $id)
    {
        $payment = payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'payment deleted successfully!');
    
    }
}
