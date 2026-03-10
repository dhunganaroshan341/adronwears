<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItineraryRequest;
use App\Models\Itinerary;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // App\Http\Controllers\Admin\ItineraryController.php



public function index($id, Request $request)
{
    if ($request->ajax()) {
        $query = Itinerary::where('tour_package_id', $id)
       ->orderBy('day_number', 'asc'); // Order by day_number ascending

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
    return '
        <div class="d-flex gap-1">
            <button class="btn btn-sm btn-warning editItineraryBtn" data-id="' . $item->id . '">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger deleteItineraryBtn" data-id="' . $item->id . '">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    ';
})

           ->addColumn('day_number', function ($item) {
    return $item->day_number . ' ' . ($item->day_number > 1 ? 'days' : 'day');
})

            ->rawColumns(['action'])
            ->make(true);
    }

    // Optional: For full-page view
    $tourPackage = TourPackage::findOrFail($id);
    return view('Admin.pages.Itinerary.index', [
        'tourPackage' => $tourPackage
    ]);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(ItineraryRequest $request)
    {
        // dd($request->all());
        // Validate the request using the ItineraryRequest
        $validated = $request->validated();


        Itinerary::create($request->all());

        return response()->json(['success' => true, 'message' => 'Itinerary created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->orderBy('order', 'asc'); // Ensure the order is ascending
        // appending previous_order and next_order



        // success message with json response
        return response()->json($itinerary);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItineraryRequest $request, $id)
{
    $validated = $request->validated();
    $itinerary = Itinerary::findOrFail($id);
    $itinerary->update($validated);

    return response()->json([ 'success'=>true,'message' => 'Itinerary updated successfully']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->delete();
        return response()->json(['success' => true, 'message' => 'Itinerary deleted successfully.']);
    }
    public function getLatestOrder($tourPackageId)
    {
        $latestOrder = Itinerary::where('tour_package_id', $tourPackageId)
            ->max('order');

        return response()->json(['latest_order' => $latestOrder]);
    }

     public function statusToggle($id)
    {
        try {
            $data = Itinerary::find($id);

            if ($data->status === 'Active') {
                $data->status = 'Inactive';
            } else {
                $data->status = 'Active';
            }
            $data->save();
            return response()->json(['success' => true, 'message' => 'Status Changes'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
