<?php

namespace App\Http\Controllers\Admin;

use App\Models\frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontendRequest;
use App\Http\Requests\SiteDataRequest;
use App\Models\SiteData;
use App\Models\SiteData_SheduleTime;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function index()
    {
        $frontend = frontend::firstOrFail();
        return view('Admin.pages.FrontEnd.frontend', compact('frontend'));
    }




    public function update(FrontendRequest $request)
    {
        try {
            // dd($request->all());
            $id = $request->input('frontend_id');
            $frontend = frontend::findOrFail($id);
            $frontend->about_us_title = $request->input('about_us_title');
            $frontend->about_us_description = $request->input('about_us_description');
            $frontend->about_us_value = $request->input('about_us_value');
            $frontend->about_us_value_description = $request->input('about_us_value_description');
            $frontend->contact_us_email = $request->input('contact_us_email');
            $frontend->contact_us_address = $request->input('contact_us_address');
            $frontend->contact_us_number = $request->input('contact_us_number');
            $frontend->save();
            return redirect()->back()->with(['message' => 'Data Updated Successfully']);
        } catch (\Exception $e) {
            Log::error('message :' . $e->getMessage());

            // return response()->json(['success'=>false,'message'=>$e->getMessage()]);
            return redirect()->back()->with(['error' => 'Something went wrong!' . $e->getMessage()]);
        }
    }


    public function siteData()
    {
        $siteData = SiteData::first();
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('Admin.pages.FrontEnd.sitedata', compact('days', 'siteData'));
    }


    public function updateSiteData(SiteDataRequest $siteDataRequest)
    {
        try {
            $siteData = SiteData::first();
            $site_title = $siteDataRequest->input('site_title');
            $site_description = $siteDataRequest->input('site_description');

            if ($siteDataRequest->hasFile('site_logo')) {
                $folderPath = 'images/SiteLogo/';
                if ($siteData->site_logo != null) {
                    Storage::disk('public')->delete($siteData->site_logo);
                }
                $imagename = time() . '.' . $siteDataRequest->site_logo;
                $path = $siteDataRequest->site_logo->storeAs($folderPath, $imagename, 'public');
                $siteData->site_image = $path;
            }
            $siteData->site_name = $site_title;
            $siteData->site_description = $site_description;
            $siteData->save();

            foreach ($siteDataRequest->starting_days as $index => $day) {

                SiteData_SheduleTime::create([
                    'site_data_id' => $siteData->id,
                    'starting_day' => $day,
                    'ending_day' => $siteDataRequest->ending_days[$index],
                    'starting_date' => $siteDataRequest->starting_dates[$index],
                    'ending_date' => $siteDataRequest->ending_days[$index],
                ]);
            }
            return back()->with(['success' => 'Site Data has been Updated']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with(['error' => 'Something went wrong ?' . $e->getMessage()]);
        }
    }
}
