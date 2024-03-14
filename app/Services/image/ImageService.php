<?php

namespace App\Services\image;

use App\Enums\ConverterTransliterated;
use ZipArchive;

class ImageService
{

    public function transliterate($filename): string
    {
        $transliterated = strtr($filename, ConverterTransliterated::CONVERTER_RU_EN);
        return mb_strtolower($transliterated, 'UTF-8');
    }

    public function getUniqueTitle($title, $image): string
    {
        $isUnique = false;
        $originalTitle = $title;
        $counter = 1;

        while (!$isUnique) {
            $existingImage = $image->where('title', $title)->first();

            if (!$existingImage) {
                $isUnique = true;
            } else {
                $title = $counter . '_' . $originalTitle;
                $counter++;
            }
        }

        return $title;
    }

    public function zipFile($filepath): string
    {

        $zip = new ZipArchive;
        $zipFileName = 'image.zip';
        $zipPath = public_path($zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $fileName = basename($filepath);
            $zip->addFile($filepath, $fileName);
            $zip->close();
        }

        return $zipPath;
    }
}
