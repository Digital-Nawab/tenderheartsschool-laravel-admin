<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            margin: 20px 0;
        }

        .order-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .order-info .info-left,
        .order-info .info-right {
            width: 48%;
        }

        .order-info div {
            margin-bottom: 10px;
        }

        .order-info .info-left div,
        .order-info .info-right div {
            font-size: 16px;
            color: #555;
        }

        .order-info .info-left strong,
        .order-info .info-right strong {
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #333;
        }

        .table td {
            color: #555;
        }

        .table .total-row td {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        .footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 10px;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .header h1 {
                font-size: 22px;
            }

            .order-info .info-left,
            .order-info .info-right {
                width: 100%;
                margin-bottom: 10px;
            }

            .order-info div {
                font-size: 14px;
            }

            .table th, .table td {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Order Received</h1>
        </div>

        <div class="content">
            <p>Dear Admin,</p>
            <p>A new order has been placed on your website. Here are the order details:</p>

            <div class="order-info">
                <div class="info-left">
                    <div><strong>Client Name:</strong> {{ $client->name }}</div>
                    <div><strong>Order Date:</strong> {{ date('j F Y', strtotime($order->created_at)) }}</div>
                </div>
                <div class="info-right">
                    <div><strong>Order Number:</strong> {{ $order->order_number }}</div>
                    <div><strong>Payment Method:</strong> {{ $order->payment_method }}</div>
                    <div><strong>Payment Status:</strong> {{ $order->payment_status }}</div>
                    <div><strong>Order Status:</strong> {{ $order->order_status }}</div>
                </div>
            </div>

            <h2>Order Items:</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orderItems as $item)
                    <tr>
                        <td><img src="{{ asset($item->product_image)}}" width="50px" alt="{{ $item->product_name }}"></td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="order-items">
                <table class="table">
                    <tr class="total-row">
                        <td colspan="6" style="text-align: right;">Grand Total:</td>
                        <td>₹{{ number_format($order->total_price, 2) }}</td>
                    </tr>
                </table>
            </div>

            <p>Please log in to the admin panel for more details or to take further actions.</p>
        </div>

        <div class="footer">
            <p>&copy; @php echo date('Y'); @endphp <a href="https://www.parvatias.com/">parvatias.com</a>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
