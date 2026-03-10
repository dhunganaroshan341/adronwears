<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Services\DataTable\CustomDataTableRequest;
use App\Services\DataTable\CustomDatatableService;
use Illuminate\Http\Request;

class ProductCategoryControllerv1 extends Controller
{
    public function index(Request $request, CustomDatatableService $dtService)
    {
        if ($request->ajax()) {

            $dt = new CustomDataTableRequest($request);

            $query = ProductCategory::with('parent');
            dd($query);

            // $query = ProductCategory::with('parent');
            return $dtService->handle($query, $dt, function ($table) {
                return $table
                    ->addIndexColumn()
                    ->addColumn('parent_category', fn ($row) => $row->parent_category)
                    ->addColumn(
                        'action',
                        fn ($row) => view('Admin.Button.button', ['data' => $row])
                    )
                    ->addColumn('status', function ($row) {
                        $checked = $row->status === 'Active' ? 'checked' : '';

                        return "<input type='checkbox' data-id='{$row->id}' {$checked}>";
                    })
                    ->rawColumns(['action', 'status']);
            });
        }
        $parentCategories = ProductCategory::whereNull('parent_id')->get();

        return view('Admin.pages.ProductCategory.categoryIndex', [

            'extraJs' => config('js-map.admin.datatable.script'),
            'extraCs' => config('js-map.admin.datatable.style'),
        ]);
    }
}
