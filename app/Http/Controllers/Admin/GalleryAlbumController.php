<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryAlbumRequest;
use App\Models\Client;
use App\Models\GalleryMedia;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryAlbumController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::all();
        $clients = Client::all();
        $extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
        );
        $albums = GalleryAlbum::all();

        return view('Admin.pages.Gallery.galleryAlbum',compact('clients','albums','extraJs','extraCs'));
    }
        public function getData(Request $request)
        {
            if ($request->ajax()) {
            $records = GalleryAlbum::with(['galleryMedia', 'client'])->withCount('galleryMedia') // <- this adds `gallery_media_count`->get();
            ->get();
                return DataTables::of($records)
                    ->addIndexColumn()
                    ->addColumn('title',function($data){
                        return $data->title;
                    })
                    ->addColumn('gallery', function ($item) {
                        return "<a type='button' data-id='" . $item->id . "' class='imageListPopup'>
                                    <span class='badge badge-primary'>" . $item->gallery_media_count . "</span>
                                </a>";
                    })


                // ->addColumn('title', fn($tit) => Str::limit($tit->title, 20) ?? '')
                ->addColumn('client', fn($client) => $client->client->name ?? '')
                ->addColumn('type', fn($type) => $type->type ?? '')
                ->addColumn('action', fn($data) => '<button class="btn btn-secondary editAlbumButton" data-id="' . $data->id . '" type="button">Edit</button>
                                                     <button class="btn btn-danger deleteData" data-id="' . $data->id . '" type="button">Delete</button>')
                ->addColumn('comment', fn($data) => '<button class="btn btn-info commentinfoBtn" data-id="' . $data->id . '" type="button">View Comments</button>')
                ->addColumn('status', fn($status) => '<div class="form-check form-switch">
                                                        <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $status->id . '" role="switch" id="flexSwitchCheckChecked" ' . ($status->status == 'Active' ? 'checked' : '') . '>
                                                      </div>')
                ->rawColumns(['action', 'gallery', 'comment', 'status'])
                ->make(true);
        }
    }

  public function store(GalleryAlbumRequest $request)
{
    DB::beginTransaction();
    try {
        $gallery = GalleryAlbum::create($request->validated());

        if ($request->hasFile('media_path')) {
            $this->handleMediaUploads($request->file('media_path'), $gallery->id);
        }

        DB::commit();
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}



    public function upload(Request $request, $id = null)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$request->hasFile('thumbnail')) {
            return response()->json([
                'success' => false,
                'message' => 'No file was uploaded.'
            ], 400);
        }

        $file = $request->file('thumbnail');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $album = GalleryAlbum::findOrFail($id);

        // Delete the old file if it exists
        $this->deleteIfExists($album->thumbnail);

        // Update with new file name
        $album->thumbnail = $filename;
        $album->save();

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'thumbnail' => $filename
        ]);
    }

    private function deleteIfExists($filename)
    {
        if ($filename) {
            $filePath = public_path('uploads/' . $filename);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }}

    public function show($id)
    {
        try {
            $album = GalleryAlbum::findOrFail($id);
            return response()->json(['success' => true, 'message' => $album]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    public function statusToggle($id)
    {
        try {
            $album = GalleryAlbum::findOrFail($id);
            $album->status = $album->status === 'Active' ? 'Inactive' : 'Active';
            $album->save();
            return response()->json(['success' => true, 'message' => 'Status changed']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function detailGalleryAlbum($id){
        try {
            $album = GalleryAlbum::with(['client','galleryMedia'])->findOrFail($id);
            // dd($album);
            return response()->json(['success' => true, 'message' => $album]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $album = GalleryAlbum::findOrFail($id);
            $album->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getGalleryAlbumData($id, Request $request)
{
    if ($request->ajax()) {
        // Fetch the specific album by ID
        $album = GalleryAlbum::find($id);

        // Fetch all albums without the thumbnail
        $albums = GalleryAlbum::all();

        // Fetch all clients
        $clients = Client::all();

        // Prepare the response data
        $data = [
            'album' => $album,
            'albums' => $albums,  // All albums without thumbnails
            'clients' => $clients,
        ];

        return response()->json([
            'success' => true,
            'message' => $data
        ]);
    }
}


public function destroyGalleryImage(Request $request)
    {
        try {
            // dd($request->all());
            $data = GalleryMedia::find($request->image_id);
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
public function update(GalleryAlbumRequest $request, $id)
{
    DB::beginTransaction();
    try {
        $album = GalleryAlbum::findOrFail($id);
        $album->update($request->validated());

        if ($request->hasFile('media_path')) {
            $this->handleMediaUploads($request->file('media_path'), $album->id);
        }

        DB::commit();
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

private function handleMediaUploads($files, $galleryId)
{
    if (!$files) return;

    foreach ($files as $key => $file) {
        // Define the folder inside your 'public' disk where files will be stored
        $folder = '/images/gallery-media';

        // Create a unique filename with timestamp and key to avoid conflicts
        $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();

        // Store the file in the 'public' disk under the specified folder
        $path = $file->storeAs($folder, $filename, 'public');

        // Save the relative path (inside storage/app/public) in the DB
        GalleryMedia::create([
            'gallery_album_id' => $galleryId,
            'media_path' => $path,  // This is relative to storage/app/public
            'status' => 'Active',
        ]);
    }
}


    }

