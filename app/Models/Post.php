<?php
namespace App\Models;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PostImage;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Post extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'description','slug', 'created_by', 'updated_by', 'status', 'views'];

public function categories()
{
    return $this->belongsToMany(Category::class, 'category_posts', 'post_id', 'category_id');
}



    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function postImages()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

  public function getFirstImageUrlAttribute()
{
    $firstImage = $this->postImages->first();

    if ($firstImage && !empty($firstImage->image)) {
        // Check if image already contains "http" or "https"
        if (filter_var($firstImage->image, FILTER_VALIDATE_URL)) {
            return $firstImage->image;  // full URL, return as is
        }
        // Otherwise, prepend asset path
        return asset('uploads/tour_images/' . $firstImage->image);
    }

    return asset('template/yatri_world/main-file/images/india.jpg');
}



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
