@extends('layout')

@section('content')
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>

    <form action="{{ route('purchase') }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <script src="https://js.stripe.com/v3/"></script>
        <div id="card-element"></div>
        <button type="submit">Purchase</button>
        <div id="card-errors" role="alert"></div>
    </form>

    <script>
        var stripe = Stripe('your-publishable-key-here'); // Replace with your own publishable key
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        card.on('change', function(event) {
            document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
        });

        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    document.getElementById('payment-form').appendChild(hiddenInput);
                    document.getElementById('payment-form').submit();
                }
            });
        });
    </script>
@endsection