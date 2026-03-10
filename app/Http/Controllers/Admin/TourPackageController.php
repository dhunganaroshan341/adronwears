<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourPackageRequest;
use App\Models\OurCountry;
use App\Models\TourPackage;
use App\Models\TourPackageImage;
use App\Models\TourPackageVideo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     protected $latestOrder = 1;
    public function __construct()
    {
        $this->middleware('auth');
        $this->latestOrder = TourPackage::max('order') ?? 0; // Get the maximum order value
        $this->latestOrder++; // Increment it for the next user
    }
public function index(Request $request)
{
    $countries = OurCountry::all();

    if ($request->ajax()) {
        $search = $request->input('search.value');
        $columns = $request->input('columns');
        $pageSize = $request->input('length');
        $order = $request->input('order')[0];
        $orderColumnIndex = $order['column'];
        $orderBy = strtolower($order['dir']) === 'desc' ? 'desc' : 'asc'; // sanitize order direction
        $start = $request->input('start');
        $orderColumn = $columns[$orderColumnIndex]['data'] ?? 'title';

        // Base query without parent join
        $query = TourPackage::leftJoin('our_countries', 'tour_packages.our_country_id', '=', 'our_countries.id')
            ->select(
                'tour_packages.*',
                'our_countries.name as country_name'
            )
            ->with('country')
            ->withCount('images');

        $total = $query->count();

        $country = $request->input('country');
        $type = $request->input('type');
        $headPackage = $request->input('head_package');

        // Apply filter with precedence chaining
        $filtered = $query;

if ($country && $country !== 'all') {
    // Apply only country filter, reset type and head package filters
    $filtered = $query->where('our_countries.id', $country);
} elseif ($type && $type !== 'all') {
    // Apply only type filter, reset head package filter
    $filtered = $query->where('tour_packages.type', $type);
} elseif ($headPackage && $headPackage !== 'all') {
    // Apply only head package filter
    $filtered = $query->where('tour_packages.parent_id', $headPackage);
}
// else no filters

// Apply search on $filtered if exists
if ($search) {
    $filtered = $filtered->where(function ($q) use ($search) {
        $q->where('tour_packages.title', 'LIKE', "%$search%")
          ->orWhere('tour_packages.slug', 'LIKE', "%$search%")
          ->orWhere('tour_packages.duration', 'LIKE', "%$search%")
          ->orWhere('tour_packages.difficulty', 'LIKE', "%$search%")
          ->orWhere('our_countries.name', 'LIKE', "%$search%");
    });
}

        $filteredCount = $filtered->count();

        // Allowed columns for ordering
        $allowedOrderColumns = [
            'title', 'duration', 'country', 'type', 'status'
        ];

        if (!in_array($orderColumn, $allowedOrderColumns)) {
            $orderColumn = 'title'; // fallback
        }

        $orderColumnMap = [
            'title' => 'tour_packages.title',
            'duration' => 'tour_packages.duration',
            'country' => 'our_countries.name',
            'type' => 'tour_packages.type',
            'status' => 'tour_packages.status',
        ];

        // Remove existing order and apply new order
        $filtered->getQuery()->orders = null;
        $orderByColumn = $orderColumnMap[$orderColumn] ?? 'tour_packages.title';
        $filtered->orderBy($orderByColumn, $orderBy);

        // Pagination
        $data = $filtered->offset($start)->limit($pageSize)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('country', fn($item) => $item->country->name ?? '-')
            ->addColumn('itinerary', function ($item) {
                $totalItineraries = $item->itineraries()->count();
                return '
                    <a href="javascript:void(0);" class="addItineraryBtn me-2" data-id="' . $item->id . '" title="Add Itinerary">
                        <i class="fas fa-plus text-success"></i>
                    </a>
                    <span class="badge bg-primary">' . $totalItineraries . ' <i class="fas fa-list-alt"></i></span>
                    <a href="javascript:void(0);" class="viewItineraryBtn ms-2" data-id="' . $item->id . '" title="View Itinerary">
                        <i class="fas fa-eye text-primary"></i>
                    </a>';
            })
            ->addColumn('batches', function ($item) {
                $totalBatches = $item->batches()->count();
                return '
                    <a href="javascript:void(0);" class="addTourBatchBtn me-2" data-id="' . $item->id . '" title="Add Batch">
                        <i class="fas fa-plus text-success"></i>
                    </a>
                    <span class="badge bg-info">' . $totalBatches . ' <i class="fas fa-calendar-alt"></i></span>
                    <a href="javascript:void(0);" class="viewTourBatchBtn ms-2" data-id="' . $item->id . '" title="View Batches">
                        <i class="fas fa-eye text-info"></i>
                    </a>';
            })
            ->addColumn('package_includes', function ($item) {
                $totalIncludes = $item->priceIncludes()->count();
                $packageName = e($item->title);
                return '
                    <a href="javascript:void(0);" class="addPriceIncludeBtn me-2" data-id="' . $item->id . '" title="Add Price Include">
                        <i class="fas fa-plus text-success"></i>
                    </a>
                    <span class="badge bg-secondary">' . $totalIncludes . ' <i class="fas fa-list"></i></span>
                    <a href="javascript:void(0);" class="viewPriceIncludeBtn ms-2" data-package_name="' . $packageName . '" data-id="' . $item->id . '" title="View Price Includes">
                        <i class="fas fa-eye text-info"></i>
                    </a>';
            })
            ->addColumn('images', function ($item) {
                $imageCount = $item->images_count ?? 0;
                return '
                    <a href="javascript:void(0);" class="imageListPopup" data-id="' . $item->id . '" title="View Images">
                        <span class="badge bg-info">' . $imageCount . ' <i class="fas fa-images ms-1"></i></span>
                    </a>
                    <a href="javascript:void(0);" class="editUploads" data-id="' . $item->id . '" title="Edit Uploads">
                        <i class="fas fa-pencil-alt text-warning"></i>
                    </a>';
            })
            ->addColumn('status', function ($item) {
    $checked = $item->status === 'Active' ? 'checked' : '';
    return '<div class="d-flex justify-content-center">
                <div class="form-check form-switch">
                    <input class="form-check-input statusToggle" type="checkbox" data-id="' . $item->id . '" ' . $checked . '>
                </div>
            </div>';
})

            ->addColumn('top_deal', fn($item) => '<input type="checkbox" class="form-check-input topDealToggle" data-id="' . $item->id . '" ' . ($item->top_deal ? 'checked' : '') . '>')
            ->addColumn('favourite_destination', fn($item) => '<input type="checkbox" class="form-check-input favouriteToggle" data-id="' . $item->id . '" ' . ($item->favourite_destination ? 'checked' : '') . '>')
            ->addColumn('action', fn($item) => view('Admin.Button.button', ['data' => $item])->render())
            ->addColumn('short_description', fn($item) => \Illuminate\Support\Str::limit(strip_tags($item->short_description), 30))
            ->rawColumns([
                'top_deal',
                'favourite_destination',
                'country',
                'batches',
                'package_includes',
                'images',
                'itinerary',
                'status',
                'action'
            ])
            ->with([
                'recordsTotal' => $total,
                'recordsFiltered' => $filteredCount,
            ])
            ->make(true);
    }

    // If not ajax, load normal page view with necessary data
    $extraJs = array_merge(
        config('js-map.admin.datatable.script'),
        config('js-map.admin.summernote.script'),
        config('js-map.admin.dropzone.script'),
        config('js-map.admin.buttons.script')
    );

    $extraCs = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        config('js-map.admin.dropzone.style'),
        config('js-map.admin.buttons.style')
    );

    $packages = TourPackage::where('status', 'Active')->get();
    $parentPackages = TourPackage::has('children')->get();

    return view('Admin.pages.TourPackage.tourPackage', [
        'extraJs' => $extraJs,
        'extraCs' => $extraCs,
        'countries' => $countries,
        'packages' => $packages,
        'parentPackages' => $parentPackages,
    ]);
}








    public function latestOrder()
    {
        try {

            return response()->json(data: ['success' => true, 'message' => $this->latestOrder]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


   public function statusToggle($id)
    {
        try {
            $data = TourPackage::find($id);

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
    public function topDeal($id)
{
    try {
        $data = TourPackage::findOrFail($id); // ensures record exists

        // Toggle the boolean
        $data->top_deal = !$data->top_deal;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Top Deal status changed successfully',
            'data' => $data
        ], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Tour Package not found',
            'error' => $e->getMessage()
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while changing status',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function favDestination($id)
{
    try {
        $data = TourPackage::findOrFail($id);

        // Toggle the boolean
        $data->favourite_destination = !$data->favourite_destination;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Favourite Destination status changed successfully',
            'data' => $data
        ], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Tour Package not found',
            'error' => $e->getMessage()
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while changing status',
            'error' => $e->getMessage()
        ], 500);
    }
}




    /**
     * Store a newly created resource in storage.
     */
public function store(TourPackageRequest $request)
{
    DB::beginTransaction();
    try {
        $data = $request->only([
            'title', 'price_includes','price_excludes', 'short_description', 'long_description','price','top_deal','favourite_destination',
            'duration', 'difficulty', 'max_elevation', 'best_season','parent_id',
            'start_point', 'end_point', 'our_country_id', 'status','package_type','pickup','drop'
        ]);

        // Dynamically generate slug from title
        $data['slug'] = TourPackage::generateSlug($request->title);

        if ($request->hasFile('image')) {
            $path = '/images/TourPackage/';
            $imagename = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs($path, $imagename, 'public');
            $data['image'] = $path;
        }

        TourPackage::create($data);

        DB::commit();
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}



    /**
     * Display the specified resource.
     */


     public function show(string $id)
    {
        try {
             $data = TourPackage::with('images')->findOrFail($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
public function update(TourPackageRequest $request, $id)
{
    DB::beginTransaction();
    try {
        $album = TourPackage::findOrFail($id);
        $validated = $request->validated();

        // $validated['top_deal'] = $request->has('top_deal') ? 1 : 0;
        // $validated['favourite_destination'] = $request->has('favourite_destination') ? 1 : 0;

        // Regenerate slug only if title has changed
        if ($request->has('title') && $request->title !== $album->title) {
            $validated['slug'] = TourPackage::generateSlug($request->title, $id);
        }

        $album->update($validated);

        if ($request->hasFile('image_path')) {
            foreach ($request->media_path as $key => $value) {
                $file = $request->file('image_path')[$key];
                $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/tour-packages'), $filename);
                $image = 'images/tour-packages/' . $filename;

                TourPackageImage::create([
                    'tour_package_id' => $album->id,
                    'image_path' => $image,
                ]);
            }
        }

        DB::commit();
        return response()->json(['success' => true, 'message' => $request->validated()]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = TourPackage::find($id);
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }
            $data->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    public function uploadImages(Request $request)
    {
        $request->validate([
        'tour_package_id' => 'required|exists:tour_packages,id',
        'images' => 'required|array',
        'images.*' => 'image|max:5120', // each image max 5MB
    ]);


        $tourPackageId = $request->tour_package_id;
        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tour-packages', 'public');

                $tourPackageImage = new TourPackageImage();
                $tourPackageImage->tour_package_id = $tourPackageId;
                $tourPackageImage->image_path = $path;
                $tourPackageImage->save();

                $uploadedImages[] = $tourPackageImage;
            }
        }

        return response()->json([
            'message' => 'Images uploaded successfully',
            'data' => $uploadedImages,
        ]);
    }



    public function uploadYoutube(Request $request)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        // Optionally, sanitize/validate iframe content here.
        $iframe = $request->input('iframe');

        // Save iframe or extract src URL and save as per your model
        $tourPackageVideo = new TourPackageVideo();
        $tourPackageVideo->iframe = $iframe; // Assuming this column exists
        // Assign other fields like tour_package_id if needed
        $tourPackageVideo->save();

        return response()->json([
            'message' => 'YouTube video saved successfully',
            'data' => $tourPackageVideo,
        ]);
    }

    public function bookNow($id)
    {
        try {
            $tourPackage = TourPackage::findOrFail($id);
            return view('frontend.pages.booking', compact('tourPackage'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function packageBycountry($country)
    {
        try {
            $tourPackages = TourPackage::whereHas('country', function ($query) use ($country) {
                $query->where('title', $country);
            })->get();

            if ($tourPackages->isEmpty()) {
                return redirect()->back()->withErrors(['error' => 'No packages found for this country']);
            }

            return view('frontend.pages.destination-grid', compact('tourPackages'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }public function packageByType($type)
    {
        try {
            $tourPackages = TourPackage::whereHas('country', function ($query) use ($type) {
                $query->where('name', $type);
            })->get();

            if ($tourPackages->isEmpty()) {
                return redirect()->back()->withErrors(['error' => 'No packages found for this country']);
            }

            return view('frontend.pages.destination-grid', compact('tourPackages'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deleteImages(string $id)
{
    // Find the image record
    $image = TourPackageImage::find($id);

    if (!$image) {
        return response()->json(['error' => 'Image not found'], 404);
    }

    // Assuming the image path is stored in a column, e.g., 'filepath' or 'image_path'
    $filePath = $image->image_path; // replace 'filepath' with your actual column name

    // Delete the file from storage (e.g., 'public' disk)
    if (Storage::disk('public')->exists($filePath)) {
        Storage::disk('public')->delete($filePath);
    }

    // Delete the database record
    $image->delete();

    return response()->json(['success' => 'Image deleted successfully']);
}
public function showImages($tour_package_id)
{
    $images = TourPackageImage::where('tour_package_id', $tour_package_id)->get();

    return response()->json($images);
}

}
