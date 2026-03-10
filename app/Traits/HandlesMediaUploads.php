<?php 
namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesMediaUploads
{
    protected function ensureDirectory(string $folder): string
    {
        $path = public_path($folder);

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        return $path;
    }

    protected function saveFile(UploadedFile $file, string $folder): string
    {
        $publicPath = $this->ensureDirectory($folder);

        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move($publicPath, $filename);

        return $folder.'/'.$filename;
    }

    protected function deleteFile(?string $filePath): void
    {
        if (!$filePath) return;

        $fullPath = public_path($filePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    /**
     * Handle single media (thumbnail, video, etc.)
     */
    public function handleSingleMedia(
        $request,
        string $field,
        ?string $existing = null,
        string $folder = 'uploads'
    ): ?string {
        if ($request->hasFile($field) && $request->file($field) instanceof UploadedFile) {
            $this->deleteFile($existing);
            return $this->saveFile($request->file($field), $folder);
        }

        return $existing;
    }

    /**
     * Handle multiple images (gallery)
     */
    public function handleMultipleMedia(
        $request,
        string $field,
        string $folder = 'uploads'
    ): array {
        $paths = [];

        if ($request->hasFile($field)) {
            foreach ($request->file($field) as $file) {
                if ($file instanceof UploadedFile) {
                    $paths[] = $this->saveFile($file, $folder);
                }
            }
        }

        return $paths;
    }
}
