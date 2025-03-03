<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
            background-color: #343a40;
            color: white;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
            display: block;
        }
        
        .sidebar a:hover {
            background-color: #495057;
            color: #ffdd57;
            text-decoration: underline;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 80%;
            height: auto;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .toggle-btn {
                position: absolute;
                top: 15px;
                left: 15px;
                z-index: 1000;
            }
        }

        .marquee {
            overflow: hidden;
            white-space: nowrap;
            background-color: #e9ecef;
            padding: 10px 0;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .marquee p {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 15s linear infinite;
            font-weight: bold;
        }

        @keyframes marquee {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }
    </style>
</head>
<body>

    <!-- Mobile Hamburger Button -->
    <button class="btn btn-primary d-lg-none toggle-btn" id="toggle-sidebar">
        <i class="fas fa-bars"></i> <!-- Hamburger Icon -->
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.hats') }}">Hats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.tshirts') }}">T-Shirts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.electronics') }}">Electronics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.cosmetics') }}">Cosmetics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('purchases.index') }}">View Purchases</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">View Products</a>
            </li>
            <li class="nav-item">
        <a class="nav-link" href="{{ route('payments.history') }}">Payment History</a> <!-- New link added -->
    </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="marquee">
            <p>Welcome {{ auth()->user()->name }}! Explore our e-commerce website and check out our latest products and offers!</p>
        </div>

        @yield('content')
    </div>
    
    <!-- Bootstrap & JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        });
    </script>

</body>
</html>
