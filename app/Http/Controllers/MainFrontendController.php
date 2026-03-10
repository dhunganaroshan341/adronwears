<?php

namespace App\Http\Controllers;


class MainFrontendController extends Controller
{
    //
    public function index()
    {
        return view('Frontend.Pages.index');
    }
    public function about()
    {
        return view('Frontend.Pages.about');
    }
    public function shop()
    {
        return view('Frontend.Pages.shop');
    }
    public function productDetail()
    {
        return view('Frontend.Pages.shop-single');
    }
    public function contact()
    {
        return view('Frontend.Pages.contact');
    }
}
