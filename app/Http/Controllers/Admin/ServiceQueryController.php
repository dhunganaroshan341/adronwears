<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceQuery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ServiceQueryController extends Controller
{
   public function index(Request $request)
    {

        $extraJs = array_merge(
            config('js-map.admin.datatable.script')
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style')
        );
        return view('Admin.pages.ServiceQuery.index', compact('extraJs', 'extraCs'));
    }

public function getServiceQuery(Request $request)
{
    if ($request->ajax()) {
        $search = $request->input('search.value');
        $columns = $request->input('columns');
        $pageSize = $request->input('length');
        $start = $request->input('start');
        $orderColumnIndex = $request->input('order')[0]['column'];
        $orderDir = $request->input('order')[0]['dir'];

        $query = ServiceQuery::with('service');

        $countTotal = $query->count();

        $query->when($search, function ($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%")
              ->orWhere('phone', 'LIKE', "%$search%");
        });

        $countFilter = $query->count();

        // Fix ordering column if it is DT_RowIndex
        $orderByColumn = $columns[$orderColumnIndex]['data'];
        if ($orderByColumn === 'DT_RowIndex') {
            $orderByColumn = 'id'; // fallback column
        }

        $records = $query
            ->orderBy($orderByColumn, $orderDir)
            ->offset($start)
            ->limit($pageSize)
            ->get();

        return DataTables::of($records)
            ->with([
                'recordsTotal' => $countTotal,
                'recordsFiltered' => $countFilter,
            ])
            ->addIndexColumn() // adds DT_RowIndex
            ->addColumn('service_name', function ($item) {
                return $item->service->name ?? 'N/A';
            })
            ->addColumn('action', function ($item) {
                return '
                    <button class="btn btn-danger serviceQueryDeleteBtn" type="button" data-id="' . $item->id . '" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button class="btn btn-info messageBtn" type="button" data-id="' . $item->id . '" title="View Message">
                        <i class="fas fa-eye"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}



    public function showDetail($id)
    {
        try {
            $query = ServiceQuery::with('service')->find($id);
            return response()->json(['success' => true, 'message' => $query]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            ServiceQuery::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
