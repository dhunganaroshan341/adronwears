<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\WorkingRequest;
use App\Models\Setting;
use App\Models\WorkingDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $workingHours = WorkingDay::orderBy('id', 'desc')->get();
            return DataTables::of($workingHours)
                ->addColumn('days', function ($days) {

                    $daysArray = json_decode($days->days, true);

                    return implode(',', $daysArray);
                })
                ->addColumn('action', function ($item) {
                    // $btn = '<button type="button" class="btn btn-info editWorkingBtn" data-id=' . $item->id . '>Edit</button>';
                    $btn= '<button type="button" class="btn btn-danger deleteWorkingBtn" data-id=' . $item->id . '>Delete</button>';
                    return $btn;
                })
                ->make(true);
        }
        $setting = Setting::first();
        // $setting=Setting::all();
        // dd($setting);
        $extraJs = array_merge(
            config('js-map.admin.select2.script'),
            config('js-map.admin.datatable.script'),
            config('js-map.admin.summernote.script')
        );

        $extraCs = array_merge(
            config('js-map.admin.select2.style'),
            config('js-map.admin.datatable.style'),
            config('js-map.admin.summernote.style')
        );
        return view('Admin.pages.Setting.setting', compact('setting', 'extraJs', 'extraCs'));
    }

    public function store(SettingRequest $request)
    {
        try {
            // dd($request->all());
            $setting = Setting::first();
            $data = $request->validated();

            if ($request->hasFile('logo')) {
                $folder = 'images/logo/';
                if ($setting && $setting->logo != null) {
                    Storage::disk('public')->delete($setting->logo);
                }
                $imagename = time() . '.' . $request->logo->getClientOriginalName();
                $imagepath = $request->logo->storeAs($folder, $imagename, 'public');
                $data['logo'] = $imagepath;
            }


            if (isset($data['logo'])) {
                $data['logo'] = $imagepath;
            }

            if ($request->hasFile('welcome_image')) {
                $folder = 'images/welcome_image/';
                if ($setting && $setting->welcome_image != null) {
                    Storage::disk('public')->delete($setting->welcome_image);
                }
                $imagename = time() . '.' . $request->welcome_image->getClientOriginalName();
                $imagepath = $request->welcome_image->storeAs($folder, $imagename, 'public');
                $data['welcome_image'] = $imagepath;
            }


            if (isset($data['welcome_image'])) {
                $data['welcome_image'] = $imagepath;
            }

            if ($request->hasFile('about_image')) {
                $folder = 'images/about_image/';
                if ($setting && $setting->about_image != null) {
                    Storage::disk('public')->delete($setting->about_image);
                }
                $imagename = time() . '.' . $request->about_image->getClientOriginalName();
                $imagepath = $request->about_image->storeAs($folder, $imagename, 'public');
                $data['about_image'] = $imagepath;
            }


            if (isset($data['about_image'])) {
                $data['about_image'] = $imagepath;
            }
            // dd($data);
            $setting->update($data);

            // if ($request->has('days') && count($request->days) > 0) {
            //     foreach ($request->days as $day) {

            //     }
            // }
            return back()->with(['success' => 'Setting Updated Successfully']);
        } catch (\Exception $e) {
            // Log::error('error' . $e->getTrace());
            // dd($e->getLine(), $e->getCode());
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function addWorking(WorkingRequest $request)
    {
        try {
            $starting = $request->starting_time;
            $ending = $request->ending_time;
            WorkingDay::create([
                'setting_id' => Setting::first()->id,
                'days' => json_encode($request->days),
                'starting_time' => $starting,
                'ending_time' => $ending
            ]);
            return response()->json(['success'=>true]);
        } catch (\Exception $e) {
          return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function destroyWorking($id)
    {
        try {
            WorkingDay::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
