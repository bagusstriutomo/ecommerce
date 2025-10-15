<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - All Orders</title>
    <!-- Tambahkan link Bootstrap untuk tampilan minimalis -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>All Orders</h1>
        <p>This is a list of all orders placed by users.</p>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                        <td>Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                        <td><span class="badge bg-primary">{{ $order->status }}</span></td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">View Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

