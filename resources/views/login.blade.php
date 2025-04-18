<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #3A51D5;
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
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #222;
        }

        .form-control {
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Login</h2>
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
        </form>
    </div>

    @if ($errors->has('login'))
        <p style="color:red;">{{ $errors->first('login') }}</p>
    @endif
</body>
</html>