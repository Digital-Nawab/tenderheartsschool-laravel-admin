<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Registration Notification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(66, 173, 184, 0.3);
            text-align: left;
        }

        h2 {
            color: #42adb8;
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        ul {
            padding-left: 5px;
            font-size: 16px;
            text-align: left;
            margin-top: 20px;
            list-style: none;
        }

        ul li {
            margin-bottom: 8px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Client Registration: {{ $client->name }}</h2>

        <p>Dear Admin,</p>
        <p>A new client has successfully registered on Parvatias. Below are their registration details:</p>

        <ul>
            <li><strong>Name:</strong> {{ $client->name }}</li>
            <li><strong>Email:</strong> {{ $client->email }}</li>
            <li><strong>Mobile:</strong> {{ $client->mobile_no }}</li>
        </ul>

        <p>Please ensure their account is reviewed and any necessary follow-up actions are taken.</p>
    </div>
</body>
</html>
