<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Product;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $articles = Car::latest()->with('image')->paginate(20);
        return view('welcome', compact('articles'));
    }
}
