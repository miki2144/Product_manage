<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment for {{ $product->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 15px;
            color: #333;
        }
        p {
            color: #555;
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: bold;
            display: block;
            text-align: left;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }
        .btn {
            padding: 10px;
            font-size: 16px;
            border-radius: 10px;
            color: white;
            background-color: #28a745;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #218838;
        }
        @media (max-width: 600px) {
            .container {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment for {{ $product->name }}</h2>
        <p><strong>Price:</strong> {{ number_format($product->price, 2) }}</p>
        <form action="{{ route('products.processPayment', $product->id) }}" method="POST">
            @csrf
            <label for="card_number" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required>
            
            <label for="expiration_date" class="form-label">Expiration Date</label>
            <input type="month" class="form-control" id="expiration_date" name="expiration_date" required>
            
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required>
            
            <button type="submit" class="btn">Pay Now</button>
        </form>
    </div>
</body>
</html>
