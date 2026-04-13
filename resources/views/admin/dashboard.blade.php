@extends('layout')

@section('title', 'Admin Dashboard - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-chart-line"></i> Admin Dashboard
                </h1>
                <p class="text-muted">Overview of your Student Management System</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2"><i class="fas fa-graduation-cap"></i> Total Students</p>
                            <h3 class="mb-0">{{ $stats['students_count'] }}</h3>
                        </div>
                        <span class="badge bg-primary">+{{ rand(1, 5) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2"><i class="fas fa-chalkboard-user"></i> Total Teachers</p>
                            <h3 class="mb-0">{{ $stats['teachers_count'] }}</h3>
                        </div>
                        <span class="badge bg-success">+{{ rand(1, 3) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2"><i class="fas fa-book"></i> Total Courses</p>
                            <h3 class="mb-0">{{ $stats['courses_count'] }}</h3>
                        </div>
                        <span class="badge bg-info">+{{ rand(1, 2) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2"><i class="fas fa-dollar-sign"></i> Total Revenue</p>
                            <h3 class="mb-0">${{ number_format($stats['total_revenue'], 2) }}</h3>
                        </div>
                        <span class="badge bg-warning">{{ $stats['payments_count'] }} Payments</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- More Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-2">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h3 class="mb-1">{{ $stats['batches_count'] }}</h3>
                    <p class="text-muted mb-0"><i class="fas fa-layer-group"></i> Batches</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-2">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h3 class="mb-1">{{ $stats['enrollments_count'] }}</h3>
                    <p class="text-muted mb-0"><i class="fas fa-user-check"></i> Enrollments</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-2">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h3 class="mb-1">{{ $stats['users_count'] }}</h3>
                    <p class="text-muted mb-0"><i class="fas fa-users"></i> Users</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-2">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h3 class="mb-1">{{ $stats['payments_count'] }}</h3>
                    <p class="text-muted mb-0"><i class="fas fa-receipt"></i> Payments</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-2">
            <a href="{{ route('admin.students.index') }}" class="card card-stat text-center text-decoration-none">
                <div class="card-body">
                    <h4 class="mb-1"><i class="fas fa-arrow-right"></i></h4>
                    <p class="text-muted mb-0">Manage</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-2">
            <a href="#" class="card card-stat text-center text-decoration-none">
                <div class="card-body">
                    <h4 class="mb-1"><i class="fas fa-cog"></i></h4>
                    <p class="text-muted mb-0">Settings</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-credit-card"></i> Recent Payments
                </div>
                <div class="card-body">
                    @if($recent_payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Enrollment</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_payments as $payment)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $payment->id }}</span></td>
                                        <td>{{ $payment->enrollment_id ?? 'N/A' }}</td>
                                        <td><strong>${{ number_format($payment->amount, 2) }}</strong></td>
                                        <td>{{ $payment->paid_date ? \Carbon\Carbon::parse($payment->paid_date)->format('M d, Y') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No recent payments
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-check"></i> Recent Enrollments
                </div>
                <div class="card-body">
                    @if($recent_enrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Batch</th>
                                        <th>Student</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_enrollments as $enrollment)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $enrollment->id }}</span></td>
                                        <td>{{ $enrollment->batch_id ?? 'N/A' }}</td>
                                        <td>{{ $enrollment->student_id ?? 'N/A' }}</td>
                                        <td>{{ $enrollment->join_date ? \Carbon\Carbon::parse($enrollment->join_date)->format('M d, Y') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No recent enrollments
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .card-stat {
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .card-stat:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    .card-stat .card-body {
        padding: 1.5rem;
    }

    .card-stat h3 {
        font-size: 2rem;
        font-weight: bold;
        color: #0d6efd;
    }
</style>

@endsection
