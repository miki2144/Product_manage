@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Purchase</h2>

    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $purchase->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount ($)</label>
            <input type="number" name="amount" class="form-control" value="{{ $purchase->amount }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Purchase</button>
    </form>
</div>
@endsection
