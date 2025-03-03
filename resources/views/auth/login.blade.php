<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px; /* Reduced margin for better mobile experience */
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .register-link {
            margin-top: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 50px; /* Rounded corners */
            padding: 10px 20px; /* Minimized padding */
        }
        .login-button {
            width: auto; /* Minimized button width */
            padding: 10px 70px; /* Padding for the button */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            display: block; /* Center the button */
            margin: 0 auto; /* Center the button */
        }
        .login-button:hover {
            background-color: #0056b3;
        }


        @media (max-width: 576px) {
            .container {
                margin-top: 20px; /* Further reduced margin on small screens */
            }
            .card {
                padding: 20px; /* Reduced padding for smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8"> <!-- Responsive column sizes -->
                <div class="card p-4">
                    <h2 class="text-center my-4">Login</h2>
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </form>
                    <div class="text-center register-link">
                        <a href="{{ route('register') }}">Don't have an account? Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>