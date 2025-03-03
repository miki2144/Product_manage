<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
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
        }
        .sidebar a {
            color: white;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 260px; /* Sidebar width + some spacing */
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center">Product Categories</h4>
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
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
