<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Thank You for Contacting Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #2c3e50;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello {{ $formData['name'] ?? 'there' }},</h2>

        <p>Thank you for contacting us. We have received your message and our team will get back to you as soon as
            possible.</p>



        <p>Best regards,<br>
            <strong>{{ config('app.name') }}</strong>
        </p>
    </div>
</body>

</html>
