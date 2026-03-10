<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(){
        $users=User::all();

        $admin=$users->where('role','Admin')->count();
        $user=$users->where('role','User')->count();
        $totaluser=$users->count();
        $today_post = Post::whereDate('created_at',today())->count();

        $totalpost=Post::count();
        $totalPackages=TourPackage::count();
        // $totalBillNumber = Bill::whereDate('created_at',date('Y-m-d'))->count();
        $extraJs=array_merge(
            config('js-map.admin.chartjs')
        );
        return view('Admin.pages.Dashboard.index',compact('totalPackages','totaluser','admin','user','today_post','totalpost','extraJs'));
    }
}
