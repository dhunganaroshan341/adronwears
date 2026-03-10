<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    protected $latestOrder = 1;
    public function __construct()
    {
        $this->middleware('auth');
        $this->latestOrder = User::max('order') ?? 0; // Get the maximum order value
        $this->latestOrder++; // Increment it for the next user
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('order', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($item) {
                    if ($item->image != null && $item->role == 'Admin') {
                        $url = asset('uploads/' . $item->image); // Get image URL
                        $defaultImage = asset('defaultImage/defaultimage.webp');
                        return ' <td class="py-1"><img src="' . $url . '" width="50" height="50" onerror="this.src=\'' . $defaultImage . '\"/></td>';
                    } elseif (($item->image != null && $item->role == 'User')) {
                        $defaultImage = asset('defaultImage/defaultimage.webp');
                        return ' <td class="py-1"><img src="' . $item->image . '" width="50" height="50" onerror="this.src=\'' . $defaultImage . '\"/></td>';
                    } else {
                        $url = asset('defaultImage/defaultimage.webp');
                        return ' <td class="py-1"><img src="' . $url . '" width="50" height="50"/></td>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $user="User";
                    $latestOrder = $this->latestOrder;
                    return view('Admin.Button.button', compact('data','user'));
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script'),
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style'),
        );

        return view('Admin.pages.User.users', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {

            $folder = 'images/users/';
            $user = new User();
            if ($request->hasFile('image')) {

                // Delete the previous images
                // if ($user->profile) {
                //     Storage::disk('public')->delete($user->profile);
                // }

                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($folder, $imagename, 'public');
                $user->image = $path;
            }
            $user->role = "Admin";
            $user->full_name = $request->full_name;
            $user->position = $request->position;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->phonenumber = $request->phonenumber;
            $user->email_link = $request->email_link;
            $user->facebook_link = $request->facebook_link;
            $user->instagram_link = $request->instagram_link;
            $user->twitter_link = $request->twitter_link;
            $user->notes = $request->notes;
            $user->save();

            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'line' => $e->getLine(), 'moredata' => $e->getCode()]);
        }
    }


    public function userDetail($id)
    {
        try {
            $data = User::find($id);
            return response()->json(data: ['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function latestOrder()
    {
        try {

            return response()->json(data: ['success' => true, 'message' => $this->latestOrder]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            // dd($user);
            $data = $request->all();

            $folder = 'images/users/';
            if ($request->hasFile('image')) {
                if ($user->image != null) {
                    Storage::disk('public')->delete($user->image);
                }
                $imagename = time() . '.' . $request->image->extension();
                $path = $request->image->storeAs($folder, $imagename, 'public');
                $data['image'] = $path;
            }

            $user->update($data);
            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function passwordReset(Request $request, $id)
    {
        try {
            $request->validate([
                'newPassword' => 'required',
                'confirmPassword' => 'same:newPassword',
            ]);
            $userid = User::find($id);
            $userid->password = $request->newPassword;
            $userid->save();
            return response()->json(['success' => true, 'message' => 'Password Changed Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function destory($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->delete();
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
