<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $isAdminNotification ? 'New order notification' : 'Order confirmation' }}</title>
</head>
<body>
    @if ($isAdminNotification)
        <h1>New order placed</h1>
        <p>A new order was placed by {{ $order->customer_name }}.</p>
    @else
        <h1>Thank you for your order</h1>
        <p>Hi {{ $order->customer_name }}, we have received your order.</p>
    @endif

    <p><strong>Order number:</strong> {{ $order->order_number }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Total:</strong> ${{ number_format((float) $order->total_amount, 2) }}</p>

    <h2>Items</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format((float) $item->price, 2) }}</td>
                    <td>${{ number_format((float) $item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($isAdminNotification)
        <h2>Customer details</h2>
        <p>{{ $order->customer_name }}<br>
        {{ $order->customer_email }}<br>
        {{ $order->customer_phone }}<br>
        {{ $order->shipping_address }}</p>
    @endif
</body>
</html>
