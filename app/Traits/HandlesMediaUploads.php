<?php

namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesMediaUploads
{
    protected function saveFile(UploadedFile $file, string $folder): string
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs(
            trim($folder, '/'),
            $filename,
            'public'
        );
    }

    protected function deleteFile(?string $filePath): void
    {
        if ($filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }

    public function handleSingleMedia($request, string $field, ?string $existing = null, string $folder = ''): ?string
    {
        if ($request->hasFile($field)) {
            $this->deleteFile($existing);

            return $this->saveFile($request->file($field), $folder);
        }

        return $existing;
    }

    public function handleMultipleMedia($request, string $field, string $folder = ''): array
    {
        $paths = [];

        if ($request->hasFile($field)) {
            foreach ($request->file($field) as $file) {
                $paths[] = $this->saveFile($file, $folder);
            }
        }

        return $paths;
    }
}
