<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Management')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styling */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            margin: 0 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Main Content */
        .main-container {
            flex: 1;
            padding: 2rem 0;
        }

        .page-header {
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 1rem;
        }

        .page-title {
            font-weight: 700;
            color: var(--dark-text);
            font-size: 2rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease;
            margin-bottom: 2rem;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #0a5fc7);
            color: white;
            border: none;
            border-radius: 0.5rem 0.5rem 0 0;
            font-weight: 600;
            padding: 1.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .btn-primary, .btn-success, .btn-danger, .btn-warning, .btn-info {
            border: none;
        }

        .btn-primary:hover {
            background-color: #0a5fc7;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }

        /* Tables */
        .table {
            background: white;
            border-radius: 0.5rem;
        }

        .table thead th {
            background-color: var(--light-bg);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            border-bottom: 2px solid #dee2e6;
            padding: 1rem;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Forms */
        .form-control, .form-select {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-text);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.5rem;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: var(--success-color);
        }

        .alert-danger {
            border-left-color: var(--danger-color);
        }

        .alert-warning {
            border-left-color: var(--warning-color);
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            border-top: 3px solid var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .main-container {
                padding: 1rem 0;
            }
        }
    </style>
</head>
<body>

    {{-- ✅ Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : '#' }}">
                <i class="fas fa-graduation-cap"></i> Student Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Admin Navigation -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.students.index') }}">
                                <i class="fas fa-users"></i> Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.teachers.index') }}">
                                <i class="fas fa-chalkboard-user"></i> Teachers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.courses.index') }}">
                                <i class="fas fa-book"></i> Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.batches.index') }}">
                                <i class="fas fa-layer-group"></i> Batches
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.enrollments.index') }}">
                                <i class="fas fa-clipboard-list"></i> Enrollments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.payments.index') }}">
                                <i class="fas fa-credit-card"></i> Payments
                            </a>
                        </li>
                    @elseif(auth()->check() && auth()->user()->role === 'user')
                        <!-- User Navigation -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.courses') }}">
                                <i class="fas fa-book"></i> Available Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.enrollments') }}">
                                <i class="fas fa-user-check"></i> My Enrollments
                            </a>
                        </li>
                    @endif

                    @if(auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="main-container">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    {{-- Footer --}}
    <footer>
        <p>&copy; 2025 Student Management System. All Rights Reserved.</p>
        <p>Developed with <i class="fas fa-heart" style="color: #dc3545;"></i> for Education</p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>