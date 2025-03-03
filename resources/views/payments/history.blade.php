<div class="container my-5">
    <h1 class="text-center mb-4">Payment History</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ optional($payment->user)->name ?? 'N/A' }}</td>
                        <td>{{ optional($payment->product)->name ?? 'N/A' }}</td>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 15px;
        text-align: left;
        vertical-align: middle;
    }

    .table th {
        background-color: #343a40; /* Dark background for header */
        color: white; /* White text for header */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2; /* Light gray for alternate rows */
    }

    .container {
        background-color: #ffffff; /* White background for container */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        padding: 20px; /* Padding inside the container */
    }

    h1 {
        color: #333; /* Dark color for the heading */
    }
</style>
