<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .btn {
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            border-radius: 25px;
            color: white;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Added shadow */
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px); /* Lift effect on hover */
        }
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #28a745;
            color: white;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        td img {
            width: 100px;
            height: auto;
        }
        form {
            display: inline;
        }
        @media (max-width: 768px) {
            h2 {
                font-size: 1.5em;
            }
            .btn {
                padding: 8px 15px;
            }
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <h2>Product Management</h2>
    
    <div class="text-center mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Year of Purchase</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                No image available
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->year_of_purchase }}</td>
                        <td>{{ $product->is_available ? 'Available' : 'Not Available' }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>