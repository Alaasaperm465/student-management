<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
        }

        .auth-container {
            width: 100%;
            max-width: 480px;
            padding: 2rem;
        }

        .auth-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary-color), #0a5fc7);
            color: white;
            text-align: center;
            padding: 2rem 1.5rem;
            border: none;
        }

        .auth-header h3 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
        }

        .auth-header p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0;
        }

        .auth-body {
            padding: 2rem 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control {
            border: 2px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), #0a5fc7);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #0a5fc7, #0952a3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
            color: white;
        }

        .auth-footer {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #dee2e6;
        }

        .auth-footer p {
            margin: 0;
            color: #6c757d;
            font-size: 0.95rem;
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-footer a:hover {
            color: #0a5fc7;
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 0.375rem;
            border-left: 4px solid;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            border-left-color: #dc3545;
            background-color: #f8d7da;
            color: #721c24;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo-section i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212529;
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 1rem;
            }

            .auth-header {
                padding: 1.5rem 1rem;
            }

            .auth-header h3 {
                font-size: 1.5rem;
            }

            .auth-body {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body>

<div class="auth-container">
    <div class="auth-card">
        {{-- Header --}}
        <div class="auth-header">
            <div class="logo-section">
                <i class="fas fa-user-plus"></i>
            </div>
            <h3>Create Account</h3>
            <p>Join Student Management System</p>
        </div>

        {{-- Body --}}
        <div class="auth-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register_post') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required autofocus 
                           placeholder="Enter your full name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" required 
                           placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           required placeholder="Enter your password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock"></i> Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           required placeholder="Confirm your password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-register w-100">
                    <i class="fas fa-user-check"></i> Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>