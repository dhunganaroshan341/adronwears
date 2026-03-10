<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
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
            $order = $request->input('order')[0];
            $orderColumnIndex = $order['column'];
            $orderBy = $order['dir'];
            $start = $request->input('start');

            $teamQuery = Team::query();
            $totalRecords = $teamQuery->count();

            $searchQuery = $teamQuery->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('position', 'LIKE', "%$search%")
                    ->orWhere('instagram', 'LIKE', "%$search%")
                    ->orWhere('facebook', 'LIKE', "%$search%")
                    ->orWhere('twitter', 'LIKE', "%$search%")
                    ->orWhere('linkedin', 'LIKE', "%$search%");
            });

            $filteredCount = $searchQuery->count();

            $response = $searchQuery->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize);

            return DataTables::of($response)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'));
                })
                ->addColumn('image', function ($item) {
                    $dataimage = $item->photo ? asset('uploads/' . $item->photo) : asset('defaultImage/defaultimage.webp');
                    return '<td class="py-1">
                        <img src="' . $dataimage . '" width="50" height="50" />
                    </td>';
                })
                ->addColumn('order', function ($item) {
                    return $item->order ?? 0;
                })
                ->with('recordsTotal', $totalRecords)
                ->with('recordsFiltered', $filteredCount)
                ->rawColumns(['action', 'image'])
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

        return view('Admin.pages.Team.team', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);
    }

    /**
     * Store a newly created resource.
     */
    public function store(TeamRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name','position','order','facebook','twitter','linkedin','instagram']);
            if ($request->hasFile('photo')) {
                $path = '/images/team/';
                $filename = time() . '.' . $request->photo->extension();
                $data['photo'] = $request->photo->storeAs($path, $filename, 'public');
            }

            Team::create($data);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show a single resource.
     */
    public function show($id)
    {
        try {
            $data = Team::findOrFail($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a resource.
     */
    public function update(TeamRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $team = Team::findOrFail($id);
            $team->fill($request->only(['name','position','order','facebook','twitter','linkedin','instagram']));

            if ($request->hasFile('photo')) {
                $filepath = '/images/team/';
                if ($team->photo !== null) {
                    Storage::disk('public')->delete($team->photo);
                }
                $filename = time() . '.' . $request->photo->extension();
                $team->photo = $request->photo->storeAs($filepath, $filename, 'public');
            }

            $team->save();
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Toggle status (Active/Inactive)
     */
    public function statusToggle($id)
    {
        try {
            $team = Team::findOrFail($id);
            $team->status = $team->status === 'Active' ? 'Inactive' : 'Active';
            $team->save();
            return response()->json(['success' => true, 'message' => 'Status changed'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    /**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    DB::beginTransaction();
    try {
        $team = Team::findOrFail($id);

        // Delete the photo file if exists
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }

        $team->delete();
        DB::commit();
        return response()->json(['success' => true, 'message' => 'Team member deleted successfully']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

}
