<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    return [
        'post_title' => 'required|min:3',
        'post_images' => $this->route('id') ? 'array' : 'required|array',
        'post_images.*' => 'mimes:png,jpeg,jpg,webp',
        'post_description' => 'required',

        // ✅ Expecting multiple category IDs as an array
        'category_ids' => 'required|array',
        // 'post_category_id.*' => 'required|integer|in:' . implode(',', $this->getCategoryOptions()),
        'category_ids.*'=>'required|exists:categories,id',

        // ✅ Expecting multiple tag IDs as an array
        'tag_ids' => 'nullable|array',
        'tag_ids.*' => 'integer|exists:tags,id',
    ];
}


 public function messages()
{
    return [
        'post_title.required' => 'Please Enter the Title',
        'post_title.min' => 'Title should be at least 3 characters',
        'post_images.required' => 'Please Insert the Image',
        'post_images.*.mimes' => 'Image should be of type: png, jpeg, jpg, webp',
        'post_description.required' => 'Please Enter the description',

        'post_category_id.required' => 'Please select at least one category',
        'post_category_id.*.in' => 'Selected category is invalid',

        'tag_ids.*.exists' => 'Selected tag is invalid',
    ];
}


    private function getOptions()
    {
        $options = DB::table('categories')->pluck( 'id');
        return $options->toArray();
    }
}
