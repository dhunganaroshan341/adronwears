<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($item) {
                    if ($item->image != null) {
                        $url = $item->image; // Get image URL
                        $defaultImage = asset('defaultImage/defaultimage.webp');
                        return ' <td class="py-1"><img src="' . $url . '" width="50" height="50" onerror="this.src=\''.$defaultImage.'\"/></td>';
                    } else {
                        $url = asset('defaultImage/defaultimage.webp');
                        return ' <td class="py-1"><img src="' . $url . '" width="50" height="50"/></td>';
                    }
                })
                ->addColumn('status', function ($status) {
                    $checked = $status->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch">
                    <input class="form-check-input statusToggle d-flex mx-auto" type="checkbox" data-id="' . $status->id . '" role="switch" id="flexSwitchCheckChecked" ' . $checked . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return view('Admin.Button.button', compact('data'));
                })
                ->rawColumns(['action', 'image','status'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
        );

        return view('Admin.pages.client.client', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);

    }

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
    public function store(ClientRequest $request)
    {
        try {

            $folder = 'images/client/';
            $user = new Client();
            if ($request->hasFile('image')) {

                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($folder, $imagename, 'public');
                $user->image = $path;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->contact = $request->contact;
            $user->description = $request->description;
            $user->save();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'line' => $e->getLine(), 'moredata' => $e->getCode()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Client::find($id);
            return response()->json(data: ['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

   public function toggleStatus($id)
{
    try {
        $data = Client::findOrFail($id);

        if ($data->status === 'active') {
            $data->status = 'inactive';
        } else {
            $data->status = 'active';
        }

        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Status changed to '. $data->status
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = Client::find($id);
            // dd($user);
            $data = $request->all();

            $folder = 'images/client/';
            if ($request->hasFile('image')) {
                if ($user->image != null) {
                    Storage::disk('public')->delete($user->image);
                }
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($folder, $imagename, 'public');
                $data['image'] = $path;
            }

            $user->update($data);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = Client::find($id);
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
