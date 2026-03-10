<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageBookingRequest;
use App\Mail\TourPackageBookingAutoReplyMail;
use App\Models\Booking;
use App\Models\PackageBooking;
use App\Models\TourBatch;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\TourPackageBookingMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;

class BookingController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {
    $search = $request->input('search.value');
    $status = $request->input('status'); // get from your buttons
    $columns = $request->input('columns');
    $order = $request->input('order')[0];
    $orderColumnIndex = $order['column'];
    $orderBy = $order['dir'];

    $bookingsQuery = PackageBooking::with(['tourPackage', 'tourBatch'])
        ->where('status', '!=', 'inactive');

    // 🔹 Apply status filter
    if (!empty($status) && $status !== 'all') {
        $bookingsQuery->where('status', $status);
    }

    // Filtering search
    if ($search) {
        $bookingsQuery->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('country', 'LIKE', "%$search%")
                ->orWhere('status', 'LIKE', "%$search%");
        });
    }

    // Ordering
    $orderColumnName = $columns[$orderColumnIndex]['data'] ?? 'created_at';
    $allowedColumns = ['name', 'email', 'phone', 'booking_type', 'total_people', 'price', 'status', 'created_at'];
    if (!in_array($orderColumnName, $allowedColumns)) {
        $orderColumnName = 'created_at';
    }
    $bookingsQuery->orderBy($orderColumnName, $orderBy);

    return DataTables::eloquent($bookingsQuery)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            return view('Admin.Button.button', compact('data'));
        })
        ->addColumn('status', function ($item) {
            return '<select class="form-select booking-status" data-id="' . $item->id . '">
                        <option value="pending" ' . ($item->status == 'pending' ? 'selected' : '') . '>Pending</option>
                        <option value="confirmed" ' . ($item->status == 'confirmed' ? 'selected' : '') . '>Confirmed</option>
                        <option value="cancelled" ' . ($item->status == 'cancelled' ? 'selected' : '') . '>Cancelled</option>
                    </select>';
        })
        ->addColumn('package', function ($item) {
            return optional($item->tourPackage)->title ?? '-';
        })
        ->addColumn('batch', function ($item) {
            return optional($item->tourBatch)->title ?? ($item->custom_date ?? '-');
        })
        ->rawColumns(['action', 'status'])
        ->make(true);
}


      $extraJs = array_merge(
    config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
            config('js-map.admin.moment.script'),
            config('js-map.admin.buttons.script')
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
            config('js-map.admin.buttons.style')
        );

        return view('Admin.pages.bookings.index', [
            'extraJs' => $extraJs,
            'extraCs' => $extraCs
        ]);
}



public function store(StorePackageBookingRequest $request)
{
    $ip = $request->ip();
    $key = 'tour-booking:' . $ip;

    if (RateLimiter::tooManyAttempts($key, 5)) {
        return response()->json([
            'success' => false,
            'message' => 'Too many bookings from your IP. Please try again later.'
        ], 429);
    }

    RateLimiter::hit($key, 600); // 10 minutes

    try {
        $validated = $request->validated();

        // Prepare package/batch data
        $packageTitle = null;
        $bookingDates = null;
        $batchPrice = null;

        if (!empty($validated['tour_batch_id'])) {
            $batch = TourBatch::with('tourPackage')->find($validated['tour_batch_id']);
            $validated['price'] = $batch?->price;

            $bookingDates = [
                'start_date' => $batch?->start_date?->format('Y-m-d'),
                'end_date' => $batch?->end_date?->format('Y-m-d'),
            ];

            $packageTitle = $batch?->tourPackage?->title ?? 'N/A';
            $batchPrice = $batch?->price ?? null;
        } else {
            $package = TourPackage::find($validated['tour_package_id']);
            $validated['price'] = $package?->price;
            $packageTitle = $package?->title ?? 'N/A';
        }

        $booking = PackageBooking::create($validated);

        if ($booking) {
            $bookingData = array_merge($booking->toArray(), $bookingDates ?? []);
            $bookingData['package_title'] = $packageTitle;
            $bookingData['batch_price'] = $batchPrice;

            // Send email to admin
            Mail::to('dhunganaroshan341@gmail.com')->bcc('info@ommundumtreks.com')->send(
                new TourPackageBookingMail($bookingData)
            );

            // Auto-reply to customer
            if (!empty($bookingData['email'])) {
                Mail::to($bookingData['email'])->send(
                    new TourPackageBookingAutoReplyMail($bookingData)
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Booking submitted successfully and emails sent!',
                'data' => $booking
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Booking could not be completed. Please try again.'
        ], 422);

    } catch (\Throwable $th) {
        Log::error('Booking Store Error: ' . $th->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again later.'
        ], 500);
    }
}





public function manageStatus(string $id, Request $request)
{
    $request->validate([
        'status' => 'required|in:active,inactive,pending,confirmed,cancelled'
    ]);

    $booking = PackageBooking::findOrFail($id);
    $booking->status = $request->status;
    $booking->save();

    return response()->json([
        'success' => true,
        'message' => 'Status updated successfully!',
        'data' => $booking
    ]);
}
}
