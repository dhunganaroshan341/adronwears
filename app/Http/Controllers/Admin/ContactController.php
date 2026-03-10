<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        $extraJs = array_merge(
            config('js-map.admin.datatable.script')
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style')
        );
        return view('Admin.pages.Contact.contact', compact('extraJs', 'extraCs'));
    }

    public function getContact(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value'); // Search term
            $columns = $request->input('columns'); // Column definitions
            $pageSize = $request->input('length'); // Number of records per page
            $start = $request->input('start'); // Offset for pagination
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index for sorting
            $orderBy = $request->input('order')[0]['dir']; // Sorting direction (asc/desc)

            // Quey Data
            $data = Contact::query();

            // Total Count
            $countTotal = $data->count();

            // Searching
            $data->when($search, function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%")
                        ->orWhere('subject', 'LIKE', "%$search%");
                });


                // search Count
              $countFilter  = $data->count();
              $records = $data
                ->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize);
            return DataTables::of($records)
                ->with([
                    'recordsTotal' => $countTotal, // Total records
                    'recordsFiltered' => $countFilter, // Filtered records count
                ])
                ->addIndexColumn() // Add DT_RowIndex column for numbering
                ->addColumn('action', function ($item) {
                    return '<button class="btn btn-danger newsletterDeleteBtn" type="button" data-id="' . $item->id . '">Delete</button>';
                })
                ->addColumn('title',function($tit){
                    return Str::limit($tit->title,20);
                })
                ->addColumn('subject', function ($sub) {
                    return Str::limit($sub->subject, 50); // Limit subject length
                })
                ->addColumn('message', function ($mess) {
                    return '<button class="btn btn-info messageBtn" type="button" data-id="' . $mess->id . '">View Message</button>';
                })
                ->rawColumns(['action', 'message']) // Ensure HTML is rendered
                ->make(true);
        }
    }

    public function showDetail($id)
    {
        try {
            $contact = Contact::find($id);
            return response()->json(['success' => true, 'message' => $contact]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Contact::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
