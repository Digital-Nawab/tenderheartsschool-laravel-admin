<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
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
            list-style:none
        }

        ul li {
            margin-bottom: 8px;
        }

        .btn {
            display: inline-block;
            background-color: #42adb8;
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #42adb8;
        }

        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 30px;
            text-align: left;
        }

        .contact-info {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
            text-align: left;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            margin: 0 15px;
            text-decoration: none;
            color: #42adb8;
            font-size: 30px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #42adb8;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .btn {
                width: 100%;
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Parvatias, {{ $client->name }}!</h2>

        <p>Thank you for registering with us! We're thrilled to have you as part of our community. Your account has been successfully created, and you're now ready to enjoy shopping with us.</p>

        <p>Your registration details are as follows:</p>
        <ul>
            <li><strong>Email:</strong> {{ $client->email }}</li>
            <li><strong>Password:</strong> {{ $password }}</li>
        </ul>

        <p>If you have any questions or need assistance, our team is ready to help you at any time. Feel free to contact us using the information below:</p>

        <div class="contact-info">
            <p><strong>Email:</strong> <a href="mailto:info.parvatias@gmail.com">info.parvatias@gmail.com</a></p>
            <p><strong>Phone:</strong> +91-7017593153</p>
        </div>

        <a href="https://www.parvatias.com" class="btn">Start Shopping Now</a>

        <div class="footer">
            <p>Best regards,<br>The Parvatias Team</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/parvatiasjewellery" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@Parvatiasjewellery" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/parvatiasjewellery/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
