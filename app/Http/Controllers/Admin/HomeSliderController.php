<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeSlide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HomeSliderRequest;
use Yajra\DataTables\Facades\DataTables;

class HomeSliderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->get('columns');

            $pageSize = $request->input('length');
            $start = $request->input('start');
            $orderColumnIndex = $request->input('order')[0]['column'];
            $orderBy = $request->input('order')[0]['dir'];

            $homeSlide = HomeSlide::query();

            $countTotal = $homeSlide->count();

            $searchHomeSlide = $homeSlide->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('shortdesc', 'LIKE', "%$search%");
            });

            $countSearch = $searchHomeSlide->count();


            $records = $searchHomeSlide->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize);

            return DataTables::of($records)
                ->with(['recordsTotal' => $countTotal, 'recordsFiltered' => $countSearch])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'))->render();
                })
                ->addColumn('image', function ($item) {
                    $url = $item->image ? asset('uploads/' . $item->image) : asset('defaultImage/defaultimage.webp');
                    $defaultImage = asset('defaultImage/defaultimage.webp');
                    return '<img src="' . $url . '" width="50" height="50" alt="Image" onerror="this.src=\'' . $defaultImage . '\'" />';
                })
                ->addColumn('shortdesc', function ($desc) {
                    return Str::limit(strip_tags($desc->shortdesc), 70);
                })
                ->addColumn('status', function ($status) {
                    $checked = $status->status == 'Active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex">
                                <input class="form-check-input statusIdData mx-auto" type="checkbox" data-id="' . $status->id . '" role="switch" id="flexSwitchCheckChecked" ' . $checked . '>
                            </div>';
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }


        $extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
            config('js-map.admin.buttons.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
            config('js-map.admin.buttons.style'),
        );
        return view('Admin.pages.HomeSlide.homeslide', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);
    }


    public function store(HomeSliderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'shortdesc']);
            if ($request->hasFile('image')) {
                $folder = 'images/homeslide/';
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($folder, $imagename, 'public');
                $data['image'] = $path;
            }
            HomeSlide::create($data);
            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getHomeSliderDetail($id)
    {
        try {
            $data = HomeSlide::find($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(HomeSliderRequest $request, $id)
    {
        try {
            $homeslide = HomeSlide::find($id);
            $data = $request->only(['title', 'shortdesc']);
            // dd($data);
            if ($request->hasFile('image')) {
                $path = '/images/homeslide/';
                if ($homeslide->image != null) {
                    Storage::disk('public')->delete($homeslide->image);
                }
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($path, $imagename, 'public');
                $data['image'] = $path;
            }
            $homeslide->update($data);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Toggle Status
    public function statusToggle($id)
    {
        try {
            $data = HomeSlide::find($id);
            if ($data->status == 'Active') {
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

    public function destory($id)
    {
        try {
            $data = HomeSlide::find($id);
            if ($data->image!=null) {
                Storage::disk('public')->delete($data->image);
            }
            $data->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
