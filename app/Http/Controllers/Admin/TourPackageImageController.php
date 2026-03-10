<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourPackageImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $countries = Country::all();
    if ($request->ajax()) {
        $search = $request->input('search.value');
        $columns = $request->input('columns');
        $pageSize = $request->input('length');
        $order = $request->input('order')[0];
        $orderColumnIndex = $order['column'];
        $orderBy = $order['dir'];
        $start = $request->input('start');

        $query = TourPackage::with('country'); // eager load country
        $total = $query->count();

        $filtered = $query->when($search, function ($q) use ($search) {
            $q->where('title', 'LIKE', "%$search%")
                ->orWhere('slug', 'LIKE', "%$search%")
                ->orWhere('duration', 'LIKE', "%$search%")
                ->orWhere('difficulty', 'LIKE', "%$search%")
                ->orWhereHas('country', function ($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%$search%");
                });
        });

        $filteredCount = $filtered->count();

        $data = $filtered
            ->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
            ->offset($start)
            ->limit($pageSize);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('country', fn($item) => $item->country->name ?? '-')
            // In controller's addColumn:
->addColumn('itinerary', function($item) {
    return '<a href="javascript:void(0);" class="addItineraryBtn btn btn-sm btn-primary" data-id="' . $item->id . '">
                <i class="fas fa-plus"></i>
            </a>


            <a title = " view Itineraries" href="javascript:void(0);" class="addItineraryBtn btn btn-sm btn-primary" data-id="' . $item->id . '">
                <i class="fas fa-eye"></i>
            </a>


            ';
})


            ->addColumn('status', function ($item) {
                $checked = $item->status === 'active' ? 'checked' : '';
                return '<div class="form-check form-switch">
                    <input class="form-check-input statusToggle" type="checkbox" data-id="' . $item->id . '" ' . $checked . '>
                </div>';
            })
            ->addColumn('action', function ($item) {
                return view('Admin.Button.button', ['data' => $item]);
 // assuming you use reusable buttons
            })
            ->addColumn('short_description', function ($item) {
                return \Illuminate\Support\Str::limit(strip_tags($item->short_description), 30);
            })
            ->rawColumns(['itinerary','status', 'action'])
            ->with([
                'recordsTotal' => $total,
                'recordsFiltered' => $filteredCount,
            ])
            ->make(true);
    }

    // Load page normally if not AJAX
    $extraJs = array_merge(
        config('js-map.admin.datatable.script'),
        config('js-map.admin.summernote.script'),
        config('js-map.admin.buttons.script')
    );

    $extraCs = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        config('js-map.admin.buttons.style')
    );

    return view('Admin.pages.TourPackage.tourPackage', [
        'extraJs' => $extraJs,
        'extraCs' => $extraCs,
        'countries' => $countries,
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
