<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($category) }} Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-text {
            margin-bottom: 10px;
            color: #555;
        }
        .card-text strong {
            color: #333;
        }
        .btn {
            padding: 10px 15px; /* Increased padding for buttons */
            font-size: 14px; /* Slightly larger font size */
            border-radius: 25px;
            text-decoration: none;
            color: white;
            display: inline-block; /* Center alignment */
            text-align: center;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .col {
            flex: 1 1 calc(25% - 15px);
            max-width: calc(25% - 15px);
        }
        @media (max-width: 768px) {
            .col {
                flex: 1 1 calc(50% - 15px);
                max-width: calc(50% - 15px);
            }
        }
        @media (max-width: 480px) {
            .col {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
        .mb-4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <h2 class="text-center mb-4">{{ ucfirst($category) }} Products</h2>
        
        <div class="text-center mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                <strong>Price:</strong> ${{ number_format($product->price, 2) }}
                            </p>
                            <p class="card-text">
                                <strong>Description:</strong> {{ Str::limit($product->description, 100) }}
                            </p>
                            <p class="card-text">
                                <strong>Year of Purchase:</strong> {{ $product->year_of_purchase }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($product->is_available)
                                    <form action="{{ route('products.payment', $product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Make Payment</button>
                                    </form>
                                @else
                                    <button class="btn btn-danger" disabled>Not Available</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>