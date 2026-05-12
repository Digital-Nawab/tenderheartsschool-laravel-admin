<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Career Enquiry Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #0073e6;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .content table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="header">
        New Career Enquiry Received
    </div>

    <div class="content">
        <table>
            <tr>
                <td><strong>Name:</strong></td>
                <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <td><strong>mobile:</strong></td>
                <td>{{ $data['phone'] }}</td>
            </tr>
            <tr>
                <td><strong>Subject:</strong></td>
                <td>{{ $data['subject'] }}</td>
            </tr>
            <tr>
                <td><strong>Resume:</strong></td>
                <td>{{ $data['resume'] }}</td>
            </tr>

            <tr>
                <td><strong>Message:</strong></td>
                <td>{{ $data['message'] }}</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
