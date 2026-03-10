<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GlobalSlugObserver
{
    public function creating(Model $model)
    {
        $this->generateSlug($model);
    }

    public function updating(Model $model)
    {
        $this->generateSlug($model);
    }

    protected function generateSlug(Model $model)
    {
        // Only run if table has a slug column AND model has a name attribute
        if (
            $model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'slug')
            && isset($model->name)
        ) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;
            $i = 1;

            // Make slug unique under same parent_id if exists
            $query = $model->newQuery();

            if (isset($model->parent_id)) {
                $query->where('parent_id', $model->parent_id);
            } else {
                $query->whereNull('parent_id');
            }

            // Exclude self if updating
            if ($model->exists) {
                $query->where('id', '!=', $model->id);
            }

            while ($query->where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-{$i}";
                $i++;
            }

            $model->slug = $slug;
        }
    }
}
