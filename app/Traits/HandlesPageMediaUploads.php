<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HandlesPageMediaUploads
{
    /**
     * Handle single media uploads.
     * Deletes old files from public path and stores new ones.
     */
    public function handleSingleMediaUploads(Request $request, array $fields, array $existingData = [], $folder = 'uploads/pages')
    {
        $mediaData = [];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if (!empty($existingData[$field]) && file_exists(public_path($existingData[$field]))) {
                    @unlink(public_path($existingData[$field]));
                }

                // Store new file
                $file = $request->file($field);
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path($folder), $fileName);
                $mediaData[$field] = "$folder/$fileName";
            }
        }

        return $mediaData;
    }

    /**
     * Handle gallery uploads (multiple images).
     */
    public function handleGalleryUploads(Request $request, $field = 'gallery_images', $folder = 'uploads/pages/gallery')
    {
        $paths = [];

        if ($request->hasFile($field)) {
            foreach ($request->file($field) as $file) {
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path($folder), $fileName);
                $paths[] = "$folder/$fileName";
            }
        }

        return $paths;
    }
}
