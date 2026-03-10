<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourBatch;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Requests\TourBatchRequest;
use Yajra\DataTables\Facades\DataTables;

class TourBatchController extends Controller
{
    // List all batches for a specific tour package


public function index($tourPackageId, Request $request)
{
    if ($request->ajax()) {
        $query = TourBatch::where('tour_package_id', $tourPackageId)->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                return '
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-warning editTourBatchBtn" data-id="' . $item->id . '">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger deleteTourBatchBtn" data-id="' . $item->id . '">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                ';
            })
            ->editColumn('start_date', function ($item) {
                return \Carbon\Carbon::parse($item->start_date)->format('Y-m-d');
            })
            ->editColumn('end_date', function ($item) {
                return \Carbon\Carbon::parse($item->end_date)->format('Y-m-d');
            })
            ->editColumn('max_people', fn ($item) => $item->max_people ?? 'N/A')
            ->editColumn('available_seats', fn ($item) => $item->available_seats ?? 'N/A')
            ->rawColumns(['action'])
            ->make(true);
    }

    // Optional full page load for fallback or debugging
    $tourPackage = TourPackage::findOrFail($tourPackageId);
    return view('Admin.pages.TourBatch.index', compact('tourPackage'));
}

    // Store new batch
    public function store(TourBatchRequest $request)
    {
        $batch = TourBatch::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Batch created successfully.',
            'data' => $batch
        ]);
    }

    // Show a specific batch
    public function show($id)
    {
        $batch = TourBatch::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $batch
        ]);
    }

    // Update batch
    public function update(TourBatchRequest $request, $id)
    {
        $batch = TourBatch::findOrFail($id);
        $batch->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Batch updated successfully.',
            'data' => $batch
        ]);
    }

    // Delete batch
    public function destroy($id)
    {
        $batch = TourBatch::findOrFail($id);
        $batch->delete();

        return response()->json([
            'success' => true,
            'message' => 'Batch deleted successfully.'
        ]);
    }
}
