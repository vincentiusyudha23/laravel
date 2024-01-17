<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('welcome', compact('products'));
    }
    public function generateFeed(){
        $products = Product::all();
        
        $xmlContent = view('feed-products', compact('products'))->render();

        // Save or send as HTTP response
        $path = Storage::put('feed.xml',$xmlContent);

        return response($xmlContent)->header('Content-Type', 'application/xml');
    }
}
