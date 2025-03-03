<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
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
            margin-bottom: 20px;
            color: #333;
        }
        .btn {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Purchase History</h2>
    <a href="{{ route('purchases.create') }}" class="btn btn-success mb-3">Add Purchase</a>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Stripe Charge ID</th>
                <th>Purchased At</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->product->name ?? 'N/A' }}</td>
                    <td>${{ number_format($purchase->amount, 2) }}</td>
                    <td>{{ $purchase->stripe_charge_id }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $purchase->product->is_available ? 'Available' : 'Not Available' }}</td>
                    <td>
                        <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>