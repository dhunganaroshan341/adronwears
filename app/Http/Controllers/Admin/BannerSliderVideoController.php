<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSliderVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

   use Illuminate\Support\Facades\DB;

class BannerSliderVideoController extends Controller
{
    public function index()
    {
        $video = BannerSliderVideo::latest()->first();
        // Load page normally if not AJAX
    $extraJs = array_merge(
        config('js-map.admin.datatable.script'),
        config('js-map.admin.summernote.script'),
        config('js-map.admin.dropzone.script'),
        config('js-map.admin.buttons.script')
    );

    $extraCs = array_merge(
        config('js-map.admin.datatable.style'),
        config('js-map.admin.summernote.style'),
        config('js-map.admin.dropzone.style'),
        config('js-map.admin.buttons.style')
    );
        return view('Admin.pages.BannerVideo.uploadVideo', compact('video','extraJs','extraCs'));
    }


public function store(Request $request)
{
    $request->validate([
        'video' => 'required|file|mimetypes:video/mp4,video/ogg,video/webm|max:102400', // max 100MB
    ]);

    DB::beginTransaction();

    try {
        // Delete existing video record and file if exists
        $existing = BannerSliderVideo::latest()->first();

        if ($existing) {
            $oldPath = public_path($existing->url);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $existing->delete();
        }

        $file = $request->file('video');
        $folder = 'uploads/banner_videos';  // relative to public/
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Make sure the folder exists
        if (!File::exists(public_path($folder))) {
            File::makeDirectory(public_path($folder), 0775, true);
        }

        // Move the uploaded file manually
        $file->move(public_path($folder), $fileName);

        // Save relative path starting from 'uploads/...'
        $relativePath = $folder . '/' . $fileName;

        BannerSliderVideo::create([
            'type' => 'upload',
            'url' => $relativePath, // e.g. uploads/banner_videos/12345_video.mp4
        ]);

        DB::commit();

        return redirect()->back()->with('success', 'Video uploaded and saved successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Upload failed: ' . $e->getMessage()]);
    }
}

}

