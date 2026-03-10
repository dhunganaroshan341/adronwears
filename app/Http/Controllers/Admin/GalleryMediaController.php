<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryMediaRequest;
use App\Models\GalleryAlbum;
use App\Models\GalleryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class GalleryMediaController extends Controller
{
    public function index()
    {
        $extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
        );
        $albums = GalleryAlbum::all();
        return view('admin.pages.Gallery.galleryMedia',compact('albums','extraJs','extraCs'));
    }

    public function getGalleryData(Request $request)
    {
        if ($request->ajax()) {

            $records = GalleryMedia::with('galleryAlbum')->get();

            // Group and extract one representative from each group
            $grouped = $records->groupBy(fn($item) => $item->galleryAlbum->title . '-' . $item->type)
                               ->map(fn($group) => $group->first())
                               ->values(); // reindex the collection

            return DataTables::of($grouped)
                ->addIndexColumn()
                ->addColumn('album', fn($row) => $row->galleryAlbum->title ?? 'N/A')
                ->addColumn('media_path', function ($query) {
                    return '<img src="' . url($query->media_path) . '" class="img-fluid" width="100px" height="100px" alt="">';
                })
                ->addColumn('type', fn($row) => $row->galleryAlbum->type ?? 'N/A')
                ->addColumn('action', fn($data) => '
                    <button class="btn btn-secondary editUserButton" data-id="' . $data->id . '" type="button">Edit</button>
                    <button class="btn btn-danger deleteData" data-id="' . $data->id . '" type="button">Delete</button>
                ')
                ->addColumn('status', fn($status) => '
                    <div class="form-check form-switch">
                        <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $status->media_id . '" role="switch" id="flexSwitchCheckChecked" ' . ($status->status == 'Active' ? 'checked' : '') . '>
                    </div>
                ')
                ->rawColumns(['action', 'status', 'media_path'])
                ->make(true);
        }
    }



    public function store(Request $request)
    {
        $imageName = null;
        // dd($request->all());

        // Handle media_path file upload if file was sent
        if ($request->hasFile('media_path')) {
            foreach ($request->media_path as $key => $value) {
                $imageName = Str::uuid() . '.' . $value->getClientOriginalExtension();
                $value->move(public_path('images/gallery-media'), $imageName);
                GalleryMedia::create([
                    'gallery_album_id' => $request->gallery_album_id,
                    'media_path' => 'images/gallery-media/'.$imageName,
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Media created successfully.']);
    }

    public function getDetail($id)
    {
        $media = GalleryMedia::findOrFail($id);
        return response()->json($media);
    }

    public function update(GalleryMediaRequest $request, $id)
    {
        $media = GalleryMedia::findOrFail($id);
        $imageName = $media->media_path;

        if ($request->hasFile('media_path')) {
            $image = $request->file('media_path');
            $newImageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/gallery-media'), $newImageName);

            // Delete old file
            if ($imageName && file_exists(public_path('images/gallery-media/' . $imageName))) {
                unlink(public_path('images/gallery-media/' . $imageName));
            }

            $imageName = $newImageName;
        }

        $media->update([
            'gallery_album_id' => $request->gallery_album_id,
            'media_path' => $imageName ?? $request->media_path,
            'status' => $request->status === 'Active' ? 1 : 0,
        ]);

        return response()->json(['success' => true, 'message' => 'Media updated successfully.']);
    }

    public function statusToggle($id)
    {
        $media = GalleryMedia::findOrFail($id);
        $media->status = !$media->status;
        $media->save();

        return response()->json(['success' => true, 'message' => 'Status updated.']);
    }

    public function edit($id){
        $media = GalleryMedia::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => $media
        ]);
    }
    public function upload(Request $request, $id = null)
    {
        $request->validate([
            'media_path' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // customize mime/types
        ]);

        if ($request->hasFile('media_path')) {
            $file = $request->file('media_path');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/gallery-media'), $filename);

            // If ID is provided, delete previous file and update media
            if ($id) {
                $media = GalleryMedia::findOrFail($id);

                // Delete old file if exists
                if ($media->media_path) {
                    $oldPath = public_path('images/gallery-media/' . $media->media_path);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Save new file reference
                $media->media_path = $filename;
                $media->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully.',
                'filename' => $filename
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded.'
        ], 400);
    }

    public function destoryImage(Request $request)
    {
        try {
            // dd($request->all());
            $data = GalleryMedia::find($request->media_path);
            //    dd($data->image);
            if ($data->image != null) {
                Storage::disk('public')->delete($data->image);
            }
            $data->delete();

            return response()->json(['success' => true, 'message' => 'Image Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'line' => $e->getTrace()]);
        }
    }
    public function destroy($id)
    {
        $media = GalleryMedia::findOrFail($id);

        if ($media->media_path && file_exists(public_path('images/gallery-media/' . $media->media_path))) {
            unlink(public_path('images/gallery-media/' . $media->media_path));
        }

        $media->delete();

        return response()->json(['success' => true, 'message' => 'Media deleted.']);
    }
}
