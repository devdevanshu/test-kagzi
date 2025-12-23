<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        return view('frontend.home.about');
    }
    public function job()
    {
        return view('frontend.pages.job/job');
    }
    public function job2()
    {
        return view('frontend.pages.job/job2');
    }
    public function job3()
    {
        return view('frontend.pages.job/job3');
    }
    public function job4()
    {
        return view('frontend.pages.job/job4');
    }
    public function jobDetails()
    {
        return view('frontend.pages.job/jobDetails');
    }
    public function portfolio()
    {
        return view('frontend.pages.portfoliyo/portfolio');
    }
    public function portfolio2()
    {
        return view('frontend.pages.portfoliyo/portfolio2');
    }
    public function portfolio3()
    {
        return view('frontend.pages.portfoliyo/portfolio3');
    }
    public function pageError()
    {
        return view('frontend.pages.pageError');
    }
    public function faq()
    {
        return view('frontend.pages.faq');
    }
    public function login()
    {
        return view('frontend.pages.login');
    }
    public function signup()
    {
        return view('frontend.pages.signup');
    }
    public function team()
    {
        return view('frontend.pages.team');
    }
    public function testimonial()
    {
        return view('frontend.pages.testimonial');
    }
}




