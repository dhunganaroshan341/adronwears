<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageBannerRequest;
use App\Models\PageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PageBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->input('columns');
            $pageSize = $request->input('length');
            $order = $request->input('order')[0]; // Fixed this line
            $orderColumnIndex = $order['column'];
            $orderBy = $order['dir'];
            $start = $request->input('start');

            $bannerQuery = PageBanner::query();

            $totalBanner = $bannerQuery->count();

            // Apply search filter
            if ($search) {
                $bannerQuery->where(function ($query) use ($search) {
                    $query->where('page', 'LIKE', "%{$search}%")
                        ->orWhere('title', 'LIKE', "%{$search}%")
                        ->orWhere('section', 'LIKE', "%{$search}%");
                });
            }

            $filteredCount = $bannerQuery->count();

            $banners = $bannerQuery
                ->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize)
                ->get();

            return DataTables::of($banners)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'))->render();
                })
                ->addColumn('image', function ($item) {
                    $dataImage = asset('uploads/' . $item->image);
                    $defaultImage = asset('defaultImage/defaultimage.webp');
                    return '<img src="' . $dataImage . '" width="50" height="50" onerror="this.src=\'' . $defaultImage . '\'" />';
                })
                ->addColumn('description', function ($item) {
                    return Str::limit(strip_tags($item->description), 20);
                })
                ->addColumn('status', function ($item) {
                    $checked = $item->status == 'Active' ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $item->id . '" role="switch" id="flexSwitchCheckChecked" ' . $checked . '>
                            </div>';
                })
                ->with('recordsTotal', $totalBanner)
                ->with('recordsFiltered', $filteredCount)
                ->rawColumns(['action', 'image', 'status'])
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

        return view('Admin.pages.PageBanner.pageBanner', [
            'extraJs' => $extraJs,
            'extraCs' => $extraCs
        ]);
    }

    // Other methods (create, store, etc.) remain as they are for now.



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


public function store(PageBannerRequest $request)
{
    DB::beginTransaction();

    try {
        $data = $request->only(['title', 'description', 'page', 'section', 'status']); // Add other fields if needed

        if ($request->hasFile('image')) {
            $path = 'images/page-banner/';
            $imageName = time() . '.' . $request->image->extension();
            $storedPath = $request->file('image')->storeAs($path, $imageName, 'public');
            $data['image'] = $path.$imageName;
        }

        PageBanner::create($data);

        DB::commit();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
public function all(){

}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    try {
        $banner = PageBanner::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => $banner
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 404);
    }}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $banner = PageBanner::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => $banner
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageBannerRequest $request, string $id)
{
    DB::beginTransaction();

    try {
        $banner = PageBanner::findOrFail($id);

        $data = $request->only(['title', 'description', 'page', 'section', 'status']); // Include other fields if needed

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            // Store new image
            $path = 'images/page-banner/';
            $imageName = time() . '.' . $request->image->extension();
            $storedPath = $request->file('image')->storeAs($path, $imageName, 'public');
            $data['image'] = $path.$imageName;
        }

        $banner->update($data);

        DB::commit();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
public function statusToggle($id)
    {
        try {
            $data = PageBanner::find($id);

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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banner = PageBanner::findOrFail($id);

            // Delete image file if it exists
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }}
}
