<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->input('columns');
            $pageSize = $request->input('length');
            $order = $request->input('order')[0];
            $orderColumnIndex = $order['column'];
            $orderBy = $order['dir'];
            $start = $request->input('start');

            $achievement = Achievement::query();
            $totalAchievements = $achievement->count();

            $searchAchievement = $achievement->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('count', 'LIKE', "%$search%")
                    ->orWhere('icon_class', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            });

            $searchCount = $searchAchievement->count();

            $response = $searchAchievement->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize);

            return DataTables::of($response)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'));
                })
                ->addColumn('fontawesome_icon', function ($item) {
                    return '<i class="' . e($item->icon_class) . ' fa-2x"></i>';
                })
                ->addColumn('status', function ($status) {
                    $checked = $status->status == 'Active' ? 'checked' : '';
                    return '<div class="form-check form-switch">
                        <input class="form-check-input statusIdData" type="checkbox" data-id="' . $status->id . '" role="switch" ' . $checked . '>
                    </div>';
                })
                ->with('recordsTotal', $totalAchievements)
                ->with('recordsFiltered', $searchCount)
                ->rawColumns(['action', 'fontawesome_icon', 'status'])
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

        return view('Admin.pages.Achievements.achievement-table', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);
    }

    public function store(AchievementRequest $request)
    {
        DB::beginTransaction();
        try {
            Achievement::create($request->validated());
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $data = Achievement::find($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(AchievementRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $achievement = Achievement::find($id);
            $achievement->update($request->validated());
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function statusToggle($id)
    {
        try {
            $data = Achievement::find($id);
            $data->status = $data->status === 'Active' ? 'Inactive' : 'Active';
            $data->save();
            return response()->json(['success' => true, 'message' => 'Status Changed']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Achievement::find($id);
            $data->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
