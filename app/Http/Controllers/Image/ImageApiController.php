<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Services\Filters\images\FilterManager;
use Illuminate\Http\Request;

class ImageApiController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $imageFilter = new FilterManager();

        return ImageResource::collection($imageFilter->apply(Image::query(), $request->all())->get());
    }

    public function show($imageId): ImageResource
    {

        $image = Image::where('id', $imageId)->firstOrFail();

        return new ImageResource($image);
    }
}
