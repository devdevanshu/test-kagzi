<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Payment\ProductSyncService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productSyncService;

    public function __construct(ProductSyncService $productSyncService)
    {
        $this->productSyncService = $productSyncService;
    }

    public function about()
    {
        return view('frontend.home.about');
    }
    public function contact()
    {
        return view('frontend.home.contact');
    }
    public function index()
    {
        $products = $this->productSyncService->getDashboardProducts(6);
        return view('frontend.home.index', compact('products'));
    }
    public function index2()
    {
        return view('frontend.home.index2');
    }
    public function index3()
    {
        return view('frontend.home.index3');
    }
    public function index4()
    {
        return view('frontend.home.index4');
    }
    public function index5()
    {
        return view('frontend.home.index5');
    }
    
}




