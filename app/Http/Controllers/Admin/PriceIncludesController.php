<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceInclude;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PriceIncludesController extends Controller
{
    // List all price includes for a specific tour package
    public function index($tourPackageId, Request $request)
    {
        if ($request->ajax()) {
            $query = PriceInclude::where('tour_package_id', $tourPackageId)->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('type', function ($item) {
                    return $item->is_included ? '<span class="badge bg-success">Included</span>' : '<span class="badge bg-danger">Excluded</span>';
                })
                ->addColumn('action', function ($item) {
                    return '
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-warning editPriceIncludeBtn" data-id="' . $item->id . '">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger deletePriceIncludeBtn" data-id="' . $item->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['type', 'action'])
                ->make(true);
        }

        $tourPackage = TourPackage::findOrFail($tourPackageId);
        return view('Admin.pages.PriceInclude.index', compact('tourPackage'));
    }

    // Store new price include/exclude
    public function store(Request $request)
    {
        $data = $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'title' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:255',
            'is_included' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $include = PriceInclude::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Price item created successfully.',
            'data' => $include
        ]);
    }

    // Show a single item
    public function show($id)
    {
        $include = PriceInclude::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $include
        ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        $include = PriceInclude::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:255',
            'is_included' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $include->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Price item updated successfully.',
            'data' => $include
        ]);
    }

    // Delete
    public function destroy($id)
    {
        $include = PriceInclude::findOrFail($id);
        $include->delete();

        return response()->json([
            'success' => true,
            'message' => 'Price item deleted successfully.'
        ]);
    }
}
