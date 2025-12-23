<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class SolutionsController extends Controller
{
    public function about()
    {
        return view('frontend.home.about');
    }

    public function service()
    {
        return view('frontend.solutions.service');
    }
    public function serviceDetails()
    {
        return view('frontend.solutions.serviceDetails');
    }
    public function serviceDetails2()
    {
        return view('frontend.solutions.serviceDetails2');
    }
    public function serviceDetails3()
    {
        return view('frontend.solutions.serviceDetails3');
    }
    public function serviceDetails4()
    {
        return view('frontend.solutions.serviceDetails4');
    }
    public function serviceDetails5()
    {
        return view('frontend.solutions.serviceDetails5');
    }
    public function serviceDetails6()
    {
        return view('frontend.solutions.serviceDetails6');
    }
}




