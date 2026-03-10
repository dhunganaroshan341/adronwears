<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsLetterController extends Controller
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
        $orderDir = $order['dir'];
        $start = $request->input('start');

        $allowedOrderColumns = ['email', 'created_at']; // DB columns allowed for sorting
        $requestedOrderColumn = $columns[$orderColumnIndex]['data'] ?? 'email';
        $orderColumnName = in_array($requestedOrderColumn, $allowedOrderColumns) ? $requestedOrderColumn : 'email';

        $query = NewsletterSubscriber::query();

        $totalRecords = $query->count();

        if (!empty($search)) {
            $query->where('email', 'LIKE', "%{$search}%");
        }

        $filteredRecords = $query->count();

        $data = $query->orderBy($orderColumnName, $orderDir)
            ->skip($start)
            ->take($pageSize)
            ->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data->map(function ($item, $key) {
                return [
                    'DT_RowIndex' => $key + 1,
                    'email' => $item->email,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'), // Format as you want
                    'action' => '<button class="btn btn-danger newsletterDeleteBtn" data-id="' . $item->id . '">Delete</button>',
                ];
            }),
        ]);
    }

    // Normal view loading for non-AJAX
    $extraJs = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
        );

        return view('Admin.pages.NewsLetter.newsletter', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);

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
