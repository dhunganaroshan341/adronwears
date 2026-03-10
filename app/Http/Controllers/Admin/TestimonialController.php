<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonalRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->input('columns');
            $pageSize = $request->input('length');
            $order = $request->input(['order'])[0];
            $orderColumnIndex = $order['column'];
            $orderBy = $order['dir'];
            $start = $request->input('start');

            $testimonial = Testimonial::query();
            $totalTestimonial = $testimonial->count();

            $searchTestimonial = $testimonial->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('address', 'LIKE', "%$search%")
                    ->orWhere('designation', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            });

            $searchCount = $searchTestimonial->count();
            $response = $searchTestimonial->orderBy($columns[$orderColumnIndex]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize);
            return DataTables::of($response)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'));
                })
                ->addColumn('image', function ($item) {
                    $dataimage = asset('uploads/' . $item->image);
                    $defaultImage=asset('defaultImage/defaultimage.webp');
                    return ' <td class="py-1">
                    <img src="' . $dataimage . '" width="50" height="50" onerror="this.src=\''.$defaultImage.'\'"/>
                    </td>';
                })
                ->addColumn('description', function ($item) {
                    return Str::limit(strip_tags($item->description), 20);
                })
                ->addColumn('status', function ($status) {
                    $checked = $status->status == 'Active' ? 'checked' : '';
                    return '<div class="form-check form-switch">
                    <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $status->id . '" role="switch" id="flexSwitchCheckChecked" ' . $checked . '>
                    </div>';
                })
                ->with('recordsTotal', $totalTestimonial)
                ->with('recordsFiltered', $searchCount)

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
        return view('Admin.pages.TestiMonial.testimonial', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);
    }

    public function store(TestimonalRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'designation', 'address', 'description']);
            if ($request->hasFile('image')) {
                $path = '/images/testimonial/';
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($path, $imagename, 'public');
                $data['image'] = $path;
            }
            Testimonial::create($data);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function showDetail($id)
    {
        try {
            $data = Testimonial::find($id);
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function update(TestimonalRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $testimonial = Testimonial::find($id);
            $testimonial->name = $request->input('name');
            $testimonial->designation = $request->input('designation');
            $testimonial->description = $request->input('description');
            if ($request->hasFile('image')) {
                $filepath = '/images/testimonial/';
                if ($testimonial->image !== null) {
                    Storage::disk('public')->delete($testimonial->image);
                }
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($filepath, $imagename, 'public');
                $testimonial->image = $path;
            }
            $testimonial->save();
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
            $data = Testimonial::find($id);

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

    public function destroy($id)
    {
        try {
            $data = Testimonial::find($id);
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }
            $data->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
