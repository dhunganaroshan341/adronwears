<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>

<body>
    <h2>Hi {{ $booking['name'] ?? 'Traveler' }},</h2>

    <p>Thank you for booking the <strong>{{ $booking['package_title'] ?? 'our tour package' }}</strong> with Omundum
        Treks!</p>

    <p>We’ve received your request and our team will get back to you soon with more details.</p>

    <h3>Booking Summary:</h3>
    <ul>
        <li><strong>Package:</strong> {{ $booking['package_title'] ?? 'N/A' }}</li>
        <li><strong>Total People:</strong> {{ $booking['total_people'] ?? 0 }}</li>

        @if (!empty($booking['custom_date']))
            <li><strong>Custom Date:</strong> {{ $booking['custom_date'] }}</li>
        @elseif (!empty($booking['tour_batch_id']))
            <li><strong>Batch Start:</strong> {{ $booking['start_date'] ?? 'N/A' }}</li>
            <li><strong>Batch End:</strong> {{ $booking['end_date'] ?? 'N/A' }}</li>
        @endif

        <li><strong>Price:</strong> {{ $booking['price'] ?? 0 }}</li>
    </ul>

    <p>If you have any questions, feel free to reply to this email.</p>

    <p>Warm regards, <br>
        <strong>Omundum Treks Team</strong>
    </p>
</body>

</html>
