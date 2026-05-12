<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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

        .content h2 {
            font-size: 20px;
            color: #333;
        }

        .content p {
            font-size: 16px;
            color: #555;
        }

        .order-info, .order-items {
            margin-top: 20px;
        }

        .order-info ul {
            list-style-type: none;
            padding: 0;
        }

        .order-info li {
            margin-bottom: 10px;
        }

        .order-info li strong {
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

            .content h2 {
                font-size: 18px;
            }

            .order-info li, .order-items li {
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
        <h1>Order Confirmation</h1>
    </div>

    <div class="content">
        <p>Dear {{ $client->name }},</p>
        <p>Thank you for your order! We're excited to let you know that your order has been received and is being processed. Below are your order details:</p>

        <div class="order-info">
            <ul>
                <li><strong>Order Number:</strong> {{ $order->order_number }}</li>
                <li><strong>Payment Method:</strong> {{ $order->payment_method }}</li>
                <li><strong>Payment Status:</strong> {{ $order->payment_status }}</li>
                <li><strong>Order Status:</strong> {{ $order->order_status }}</li>
                <li><strong>Order Date:</strong> {{ date('j F Y', strtotime($order->created_at)) }}</li>
            </ul>
        </div>

        <h2>Order Items:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $key=>$item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
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
                    <td colspan="3" style="text-align: right;">Grand Total:</td>
                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                </tr>
            </table>
        </div>

        <p>If you have any questions or need assistance, feel free to <a href="mailto:info.parvatias@gmail.com">contact us</a>.</p>
    </div>

    <div class="footer">
        <p>&copy; @php echo date('Y'); @endphp <a href="https://www.parvatias.com/">parvatias.com</a>. All rights reserved.</p>
    </div>
</div>
</body>
</html>
