<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PostImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{

 public function index()
    {
        // External JS & CSS configs
        $extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script'),
            config('js-map.admin.select2.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
            config('js-map.admin.select2.style'),
        );

        // Load categories for filter or post creation
        $categories = Category::all();

        return view('Admin.pages.Post.post', compact('categories', 'extraJs', 'extraCs'));
    }

    /**
     * DataTable server-side processing for Posts.
     */
    public function getPostData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->input('columns');
            $pageSize = $request->input('length');
            $order = $request->input('order')[0];
            $orderIndexColumn = $order['column'];
            $start = $request->input('start');
            $orderBy = $order['dir'];

            // Start query with joins
            $posts = Post::query()
                ->join('category_posts', 'category_posts.post_id', '=', 'posts.id')
                ->join('categories', 'categories.id', '=', 'category_posts.category_id')
                ->join('users', 'users.id', '=', 'posts.created_by')
                ->leftJoin('post_images', 'post_images.post_id', '=', 'posts.id')
                ->leftJoin('comments', function ($join) {
                    $join->on('comments.commentable_id', '=', 'posts.id')
                         ->where('comments.commentable_type', Post::class);
                })
                ->select([
                    'posts.id as post_id',
                    'posts.title as post_title',
                    'posts.description',
                    'users.full_name',
                    'posts.status',
                    DB::raw('GROUP_CONCAT(DISTINCT categories.title SEPARATOR ", ") as category_titles'),
                    DB::raw('COUNT(DISTINCT post_images.id) as post_images_count')
                ])
                ->groupBy('posts.id', 'posts.title', 'posts.description', 'users.full_name', 'posts.status');

            // Total count before filtering
            $totalCount = $posts->get()->count();

            // Apply search filters
            if ($search) {
                $posts->where(function ($query) use ($search) {
                    $query->where('posts.title', 'LIKE', "%$search%")
                        ->orWhere('posts.description', 'LIKE', "%$search%")
                        ->orWhere('categories.title', 'LIKE', "%$search%")
                        ->orWhere('users.full_name', 'LIKE', "%$search%");
                });
            }

            $filterCount = $posts->get()->count();

            // Sorting map
            $columnMap = [
                'title' => 'posts.title',
                'categories' => 'category_titles',
                'description' => 'posts.description',
            ];

            $orderByColumn = $columnMap[$columns[$orderIndexColumn]['data']] ?? 'posts.title';

            // Pagination & sorting
            $records = $posts->orderBy($orderByColumn, $orderBy)
                ->offset($start)
                ->limit($pageSize)
                ->get();

            // Return formatted response
            return DataTables::of($records)
                ->addIndexColumn()
                ->addColumn('image', function ($item) {
                    return "<a type='button' data-id='" . $item->post_id . "' class='imageListPopup'><span class='badge badge-primary'>" . ($item->post_images_count ?? 0) . "</span></a>";
                })
                ->addColumn('title', fn($tit) => Str::limit($tit->post_title, 20))
                ->addColumn('categories', fn($cat) => $cat->category_titles ?? '')
                ->addColumn('description', fn($desc) => Str::limit(strip_tags($desc->description), 20))
                ->addColumn('created_by', fn($creator) => $creator->full_name ?? '')
                ->addColumn('action', fn($data) => '
                    <button class="btn btn-secondary editUserButton" data-id="' . $data->post_id . '" type="button">Edit</button>
                    <button class="btn btn-danger deleteData" data-id="' . $data->post_id . '" type="button">Delete</button>')
                ->addColumn('comment', fn($data) => '
                    <button class="btn btn-info commentinfoBtn" data-id="' . $data->post_id . '" type="button">View Comment</button>')
                ->addColumn('status', fn($status) => '
                    <div class="form-check form-switch">
                        <input class="form-check-input statusIdData d-flex mx-auto" type="checkbox" data-id="' . $status->post_id . '" role="switch" id="flexSwitchCheckChecked" ' . ($status->status == 'Active' ? 'checked' : '') . '>
                    </div>')
                ->rawColumns(['action', 'image', 'comment', 'status'])
                ->with('recordsTotal', $totalCount)
                ->with('recordsFiltered', $filterCount)
                ->make(true);
        }

        return response()->json(['message' => 'Invalid Request'], 400);
    }



private function processTags(string $rawTags=null): array
{
   if($rawTags!=null){
     return collect(explode(',', $rawTags))
        ->map(fn($tag) => trim($tag))
        ->filter()
        ->unique()
        ->values()
        ->all();

   }
   return [];

}



    public function store(PostRequest $postRequest)
    {
        DB::beginTransaction();
        try {


            $post = new Post();
            $post->title = $postRequest->input('post_title');
            $post->description = $postRequest->input('post_description');
            // $post->category_id = $postRequest->input('post_category_id');
            $post->created_by = Auth::id();
            // $post->tags = $this->processTags($postRequest->input('tags')); // assuming post_tags input
            $post->save();
            foreach($postRequest->input('category_ids') as $data){
                DB::table('category_posts')->insert([
                    'category_id'=>$data,
                    'post_id'=>$post->id
                ]);
            }

            // $post=Post::create($postRequest->all())
            // To Save Multiple Images
            if ($postRequest->hasFile('post_images')) {
                $filepath = 'images/post/';
                foreach ($postRequest->post_images as $image) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $path = $image->storeAs($filepath, $imagename, 'public');
                    PostImage::create([
                        'post_id' => $post->id,
                        'image' => $path
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


public function getDetail($id)
{
    try {
        $data = Post::with(['categories', 'postImages'])->findOrFail($id);

        // Handle tags safely: decode if JSON, otherwise wrap string into array
        $tags = $data->tags;

        if (is_string($tags)) {
            $decoded = json_decode($tags, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $tags = $decoded;
            } else {
                // Not valid JSON, convert string to array for implode
                $tags = [$tags];
            }
        } elseif (!is_array($tags)) {
            $tags = [];
        }

        $tagsString = implode(', ', $tags);

        $images = $data->postImages->map(function ($image) {
            return [
                'id' => $image->id,
                'path' => $image->image,
            ];
        });

        $categories = $data->categories->map(function ($cat) {
            return [
                'id' => $cat->id,
                'title' => $cat->title,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Post details fetched successfully.',
            'data' => [
                'id' => $data->id,
                'title' => $data->title,
                'description' => $data->description,
                'categories' => $categories,
                'tags' => $tagsString,
                'images' => $images,
            ],
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}





    public function destoryImage(Request $request)
    {
        try {
            // dd($request->all());
            $data = PostImage::find($request->image_id);
            //    dd($data->image);
            if ($data->image != null) {
                Storage::disk('public')->delete($data->image);
            }
            $data->delete();

            return response()->json(['success' => true, 'message' => 'Image Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'line' => $e->getTrace()]);
        }
    }

  public function update(PostRequest $postRequest, $id)
{
    DB::beginTransaction();
    try {
        $data = Post::findOrFail($id);
        $data->title = $postRequest->input('post_title');
        $data->description = $postRequest->input('post_description');
        $data->tags = $this->processTags($postRequest->input('tags'));

        $data->save();

        // Sync categories properly
        $data->categories()->sync($postRequest->input('category_ids', []));

        if ($postRequest->hasFile('post_images')) {
            $existingImages = PostImage::where('post_id', $id)->get();
            foreach ($existingImages as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }

            foreach ($postRequest->file('post_images') as $image) {
                $imagename = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('images/post', $imagename, 'public');

                PostImage::create([
                    'post_id' => $data->id,
                    'image' => $imagePath,
                ]);
            }
        }

        DB::commit();
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


    // Toggle Status
    public function statusToggle($id)
    {
        try {
            $data = Post::find($id);
            if ($data->status == 'Active') {
                $data->status = 'Inactive';
            } else {
                $data->status = 'Active';
            }
            $data->save();
            return response()->json(['success' => true, 'message' => 'Status Changes'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function postComment($id)
    {
        try {
            $data = Post::with(['comments'])->find($id);
            $images = $data->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'image' => $comment->user->image,
                    'name' => $comment->user->full_name
                ];
            });
            // dd($images);
            return response()->json(['success' => true, 'message' => $data, 'images' => $images]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $data = Post::with('postImages')->find($id);

            // dd($data);
            if ($data->postImages != null) {
                foreach ($data->postImages as $img) {
                    Storage::disk('public')->delete($img->image);
                }
            }
            $data->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'line' => $e->getLine(), 'which' => $e->getTrace()]);
        }
    }
    public function storePostCategories(){


    }
}
