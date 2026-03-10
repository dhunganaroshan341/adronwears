<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    if ($request->ajax()) {
        $notice = Notice::query();

        return DataTables::of($notice)
            ->addIndexColumn()
            ->addColumn('action', function ($action) {
                $btn = '<button class="btn btn-primary editNoticeBtn mr-4" data-id="' . $action->id . '" type="button">Edit</button>';
                $btn .= '<button class="btn btn-danger deleteNoticeBtn" data-id="' . $action->id . '" type="button">Delete</button>';
                return $btn;
            })
            ->addColumn('status', function ($status) {
                $checked = $status->status == 'Active' ? 'checked' : '';
                return '<div class="form-check form-switch">
                    <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $status->id . '" role="switch" ' . $checked . '>
                    </div>';
            })
            ->addColumn('image', function ($img) {
                $image = $img->image ? asset('uploads/' . $img->image) : '';
                return '<img src="' . $image . '" class="img-fluid" alt="image" />';
            })
            ->addColumn('description', function ($desc) {
                return strip_tags(Str::limit($desc->description, 50));
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make(true);
    }

    $extraJs = array_merge(
        config('js-map.admin.summernote.script'),
        config('js-map.admin.datatable.script')
    );
    $extraCs = array_merge(
        config('js-map.admin.summernote.style'),
        config('js-map.admin.datatable.style')
    );

    return view('Admin.pages.Notice.notice', compact('extraJs', 'extraCs'));
}


    public function toggleStatus($id)
    {
        try {
            $notice = Notice::find($id);
            if ($notice) {
                if (Notice::count() > 1) {
                    Notice::query()->update(['status' => 'Inactive']);
                    $notice->status = $notice->status === 'Active' ? 'Inactive' : 'Active';
                } else {
                    $notice->status = $notice->status === 'Active' ? 'Inactive' : 'Active';
                }
                $notice->save();

                return response()->json(['success' => true, 'status' => 200, 'message' => 'Status changed successfully']);
            }

            return response()->json(['success' => false, 'status' => 404, 'message' => 'Notice not found']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoticeRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $path = 'images/notice/';
                $imageName = time() . '.' . $request->image->getClientOriginalName();
                $store = $request->image->storeAs($path, $imageName, 'public');
                $data['image'] = $store;
            }
            $notice = Notice::create($data);
            // Notice::query()->update(['status'=>'Inactive']);
            DB::commit();
            return response()->json(['success' => true, 'status' => 200]);
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
            $data = Notice::find($id);
            return response()->json(['success' => true, 'message' => $data, 'status' => 200],);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(NoticeRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $notice = Notice::find($id);
            if ($request->hasFile('image')) {
                $filepath = 'images/notice/';
                if ($notice->image != null) {
                    Storage::disk('public')->delete($notice->image);
                }
                $imageName = time() . '.' . $request->image->getClientoriginalName();
                $store = $request->image->storeAs($filepath, $imageName, 'public');
                $data['image'] = $store;
            }
            $notice->update($data);
            DB::commit();
            return response()->json(['success' => true, 'status' => 200]);
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
        try {
            $notice = Notice::find($id);
            if ($notice->image != null) {
                Storage::disk('public')->delete($notice->image);
            }
            $notice->delete();
            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
