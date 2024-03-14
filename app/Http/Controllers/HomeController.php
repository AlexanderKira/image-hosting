<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\Filters\images\FilterManager;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $imageFilter = new FilterManager();
        $images = $imageFilter->apply(Image::query(), $request->all());

        return view('pages.home', ['images' => $images->latest()->paginate(6)]);
    }
}
