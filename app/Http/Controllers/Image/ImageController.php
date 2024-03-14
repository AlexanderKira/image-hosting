<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Services\image\ImageService;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;


class ImageController extends Controller
{

    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }


    public function store(ImageRequest $request, Image $image): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $images = $validated['images'];

        foreach ($images as $itemImage) {
            $title = $this->imageService
                ->getUniqueTitle(
                    $this->imageService->transliterate($itemImage->getClientOriginalName()), $image);

            $path = storage::disk('public')->putFileAs('/images', $itemImage, $title);

            $previewTitle = 'prev_' . $title;

            InterventionImage::make($itemImage)->fit(300,300)
                ->save(storage_path('app/public/images/' . $previewTitle));

            $image->create([
                'title' => $title,
                'path' => url(Storage::url($path)),
                'preview_path' => url(Storage::url( 'images/' . $previewTitle))
            ]);
        }

        return redirect()->route('page.home');
    }

    public function delete($imageId): \Illuminate\Http\RedirectResponse
    {
        $image = Image::findOrFail($imageId);
        $previewTitle = basename($image->preview_path);
        Storage::disk('public')->delete('images/' . $image->title);
        Storage::disk('public')->delete('images/' . $previewTitle);
        $image->delete();

        return redirect()->back();
    }

    public function download($imageId): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $image = Image::findOrFail($imageId);
        $file = Storage::disk('public')->path('images/' . $image->title);
        $zipPath = $this->imageService->zipFile($file);
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }



}
