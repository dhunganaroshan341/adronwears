<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'content_heading',
        'content_subheading',
        'meta_description',
        'meta_keywords',
        'title1',
        'title2',
        'short_desc1',
        'short_desc2',
        'desc1',
        'desc2',
        'image1',
        'image2',
        'video1',
        'video2',
        'gallery_images',
    ];

    protected $casts = [
        'gallery_images' => 'array',
    ];

    // Generate slug if not provided
    public static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    protected static function booted()
    {
        static::updating(function ($page) {
            foreach (['image1', 'image2', 'video1', 'video2'] as $field) {
                if ($page->isDirty($field) && !empty($page->getOriginal($field))) {
                    $oldPath = public_path($page->getOriginal($field));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }
        });

        static::deleting(function ($page) {
            foreach (['image1', 'image2', 'video1', 'video2'] as $field) {
                $filePath = public_path($page->$field);
                if (!empty($page->$field) && file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        });
    }

    // ACCESSORS for full URLs for images and videos
    public function getImage1UrlAttribute()
    {
        return $this->image1 ? asset('uploads/' . ltrim($this->image1, '/')) : null;
    }

    public function getImage2UrlAttribute()
    {
        return $this->image2 ? asset('uploads/' . ltrim($this->image2, '/')) : null;
    }

    public function getVideo1UrlAttribute()
    {
        return $this->video1 ? asset('uploads/' . ltrim($this->video1, '/')) : null;
    }

    public function getVideo2UrlAttribute()
    {
        return $this->video2 ? asset('uploads/' . ltrim($this->video2, '/')) : null;
    }
}
