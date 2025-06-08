<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class landingController extends Controller
{
    public function index()
    {
        $productIds = Product::whereHas('galleries')->where('category_id','1')->pluck('id');
        $randomIds = collect($productIds)->shuffle()->take(12);
        $products = Product::whereIn('id', $randomIds)
            ->with('galleries')
            ->get();


        return view('homeLander',compact('products'));
    }
    public function indextemp()
    {

        return view('homeLander');
    }
}
