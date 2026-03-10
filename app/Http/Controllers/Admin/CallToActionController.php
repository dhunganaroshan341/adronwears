<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallToActionRequest;
use App\Models\CallToAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CallToActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $orderColumnIndex = $request->input('order.0.column');
            $orderBy = $request->input('order.0.dir');
            $columns = $request->input('columns');
            $orderColumn = $columns[$orderColumnIndex]['data'] ?? 'id';

            $query = CallToAction::query();

            $totalRecords = $query->count();

            // Apply search filter
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('link', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            $filteredRecords = $query->count();

            // Order and paginate
            $query->orderBy($orderColumn, $orderBy);

            return DataTables::of($query)
                ->addIndexColumn()

                ->addColumn('image', function ($item) {
                    $dataimage = asset('uploads/' . $item->image);
                    $defaultImage=asset('defaultImage/defaultimage.webp');
                    return ' <td class="py-1">
                    <img src="' . $dataimage . '" width="50" height="50" onerror="this.src=\''.$defaultImage.'\'"/>
                    </td>';
                })

                ->addColumn('description', function ($item) {
                    return Str::limit(strip_tags($item->description), 20);
                }) ->addColumn('title', function ($item) {
                    return Str::limit(strip_tags($item->title), 20);
                })

                ->addColumn('status', function ($status) {
                    $checked = $status->status == 'Active' ? 'checked' : '';
                    return '<div class="form-check form-switch">
                    <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $status->id . '" role="switch" id="flexSwitchCheckChecked" ' . $checked . '>
                    </div>';
                })

                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'));
                })

                ->rawColumns(['image', 'status', 'action'])

                ->with('recordsTotal', $totalRecords)
                ->with('recordsFiltered', $filteredRecords)

                ->make(true);
        }

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

        return view('Admin.pages.CallToAction.callToAction', [
            'extraJs' => $extraJs,
            'extraCs' => $extraCs
        ]);
    }
    public function all()
    {
        // dd("test");
        try {
            $data = CallToAction::all();

            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CallToActionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'image', 'description', 'page','link']);
            if ($request->hasFile('image')) {
                $path = '/images/cta/';
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($path, $imagename, 'public');
                $data['image'] = $path;
            }
            CallToAction::create($data);
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
            $data = CallToAction::find($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $data = CallToAction::find($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CallToActionRequest $request, $id)
{
    DB::beginTransaction();

    try {
        $callToAction = CallToAction::findOrFail($id); // Use findOrFail for better error handling

        // Update fields
        $callToAction->title = $request->input('title');
        $callToAction->link = $request->input('link');
        $callToAction->description = $request->input('description');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $callToAction->image;

            // Delete old image if it exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Store new image
            $imageDirectory = 'images/cta';
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $storedPath = $request->image->storeAs($imageDirectory, $imageName, 'public');

            $callToAction->image = $storedPath;
        }

        $callToAction->save();
        DB::commit();

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function destroyImage(Request $request)
{
    try {
        $callToAction = CallToAction::findOrFail($request->id); // expecting 'id' not 'image'

        if ($callToAction->image && Storage::disk('public')->exists($callToAction->image)) {
            Storage::disk('public')->delete($callToAction->image);
            $callToAction->image = null; // unset the image path in DB
            $callToAction->save();
        }

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'trace' => $e->getTrace() // for debugging
        ]);
    }
}


    public function statusToggle($id)
    {
        try {
            $album = CallToAction::findOrFail($id);
            $album->status = $album->status === 'Active' ? 'Inactive' : 'Active';
            $album->save();
            return response()->json(['success' => true, 'message' => 'Status changed']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
