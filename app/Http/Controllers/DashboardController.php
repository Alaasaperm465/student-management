<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\teacher;
use App\Models\course;
use App\Models\Batch;
use App\Models\Enrollments;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students_count' => students::count(),
            'teachers_count' => teacher::count(),
            'courses_count' => course::count(),
            'batches_count' => Batch::count(),
            'enrollments_count' => Enrollments::count(),
            'payments_count' => Payment::count(),
            'users_count' => User::count(),
            'total_revenue' => Payment::sum('amount'),
        ];

        $recent_payments = Payment::latest()->take(5)->get();
        $recent_enrollments = Enrollments::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_payments', 'recent_enrollments'));
    }
}
