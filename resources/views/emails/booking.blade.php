<h2>New Package Booking For: {{ $booking['package_title'] ?? 'N/A' }}</h2>

<p><strong>Name:</strong> {{ $booking['name'] ?? 'N/A' }}</p>
<p><strong>Email:</strong> {{ $booking['email'] ?? 'N/A' }}</p>
<p><strong>Phone:</strong> {{ $booking['phone'] ?? 'N/A' }}</p>
<p><strong>Country:</strong> {{ $booking['country'] ?? 'N/A' }}</p>

{{-- <p><strong>Adults:</strong> {{ $booking['adult'] ?? 0 }}</p>
<p><strong>Children:</strong> {{ $booking['children'] ?? 0 }}</p> --}}
<p><strong>Total People:</strong> {{ $booking['total_people'] ?? 0 }}</p>

@if (!empty($booking['custom_date']))
    <p><strong>Custom Date:</strong> {{ $booking['custom_date'] }}</p>
@elseif (!empty($booking['tour_batch_id']))
    <p><strong>Batch Start Date:</strong> {{ $booking['start_date'] ?? 'N/A' }}</p>
    <p><strong>Batch End Date:</strong> {{ $booking['end_date'] ?? 'N/A' }}</p>
@endif

<p><strong>Price:</strong> {{ $booking['price'] ?? 0 }}</p>
<p><strong>Message:</strong> {{ $booking['message'] ?? 'N/A' }}</p>
