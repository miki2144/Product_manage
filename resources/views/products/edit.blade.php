<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        .form-control {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Product Price</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="year_of_purchase" class="form-label">Year of Purchase</label>
            <input type="number" id="year_of_purchase" name="year_of_purchase" class="form-control" value="{{ $product->year_of_purchase }}" min="1900" max="{{ date('Y') }}">
        </div>
        
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-control">
                <option value="hats" {{ $product->category == 'hats' ? 'selected' : '' }}>Hats</option>
                <option value="tshirts" {{ $product->category == 'tshirts' ? 'selected' : '' }}>T-shirts</option>
                <option value="electronics" {{ $product->category == 'electronics' ? 'selected' : '' }}>Electronics</option>
                <option value="cosmetics" {{ $product->category == 'cosmetics' ? 'selected' : '' }}>Cosmetics</option>
            </select>
        </div>
        
        <!-- Image Upload Field -->
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="width: 100px; height: auto;">
                </div>
            @else
                <p>No image uploaded.</p>
            @endif
        </div>
        
        <button type="submit" class="btn">Update</button>
    </form>
</div>

</body>
</html>