<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="//unpkg.com/alpinejs" defer></script>
    
        <style>
            body {
                background-color: #6FBcFF;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            .login-card {
                background-color: white;
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 350px;
                position: relative;
            }
    
            .login-card h2 {
                text-align: center;
                margin-bottom: 30px;
                color: #222;
            }
    
            .form-control {
                border-radius: 8px;
            }
    
            .logo {
                margin-left: -17px;
            }

            .btn-custom {
                background-color: #6FBcFF;
                color: #fff;
            }

            .btn-custom:hover {
                background-color: #5EA9E6;
                color: white;
            }

            .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            }

            .alert-danger {
                background-color: #FFE8E8;
                color: #D32F2F;
                border: 1px solid #FFCDD2;
            }

            .alert-success {
                background-color: #E8F5E9;
                color: #388E3C;
                border: 1px solid #C8E6C9;
            }

            .is-invalid {
                border-color: #D32F2F !important;
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
            }
        </style>
    </head>
    
    <body>
        <div class="login-card">
    
            {{-- Logo --}}
            <div class="logo">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo-bima-laundry-svg.svg') }}" alt="Logo Bima Laundry" style="max-height: 60px;">
                </div>
            </div>
    
            {{-- Title --}}
            <h2>Login</h2>

            {{-- Error Messages --}}
            @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0 list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Success Messages --}}
            @if (session('message'))
            <div class="alert alert-success mb-3">
                {{ session('message') }}
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                </div>
    
                <button type="submit" class="btn btn-custom w-100 mt-2">Login</button>
            </form>
    
        </div>
    </body>
</html>
