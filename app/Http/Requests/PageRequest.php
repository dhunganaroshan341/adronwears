    <?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users or add auth check
    }

public function rules(): array
{
    $pageId = $this->route('page'); // or $this->id or $this->route('id'), depending on route param name

    return [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:pages,slug,' . ($pageId ?? 'NULL'),
        // other rules...
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'meta_keywords' => 'nullable|string|max:255',
        'title1' => 'nullable|string|max:255',
        'title2' => 'nullable|string|max:255',
        'short_desc1' => 'nullable|string|max:255',
        'short_desc2' => 'nullable|string|max:255',
        'desc1' => 'nullable|string',
        'desc2' => 'nullable|string',
        'content' => 'nullable|string',
        'video1' => 'nullable|string|max:255',
        'video2' => 'nullable|string|max:255',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ];
}


}
