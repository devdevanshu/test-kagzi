<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        return view('frontend.blog.blog');
    }
    public function blog2()
    {
        return view('frontend.blog.blog2');
    }
    public function blogDetails()
    {
        return view('frontend.blog.blogDetails');
    }
}




