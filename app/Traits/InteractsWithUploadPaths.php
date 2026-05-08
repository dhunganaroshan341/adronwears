<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait InteractsWithUploadPaths
{
    protected function getUploadableColumns(): array
    {
        return property_exists($this, 'uploadable')
            ? $this->uploadable
            : [];
    }

    protected function getUploadDirectory(): string
    {
        return property_exists($this, 'uploadDirectory')
            ? $this->uploadDirectory
            : 'uploads';
    }

    public function getAttribute($key)
    {
        if (Str::endsWith($key, '_url')) {

            $column = Str::before($key, '_url');

            if (in_array($column, $this->getUploadableColumns())) {

                $path = parent::getAttribute($column);

                if (!$path) {
                    return null;
                }

                return asset(
                    trim($this->getUploadDirectory(), '/') . '/' . ltrim($path, '/')
                );
            }
        }

        return parent::getAttribute($key);
    }

    public function toArray()
    {
        $array = parent::toArray();

        foreach ($this->getUploadableColumns() as $column) {

            $path = parent::getAttribute($column);

            $array[$column . '_url'] = $path
                ? asset(
                    trim($this->getUploadDirectory(), '/') . '/' . ltrim($path, '/')
                )
                : null;
        }

        return $array;
    }
}
