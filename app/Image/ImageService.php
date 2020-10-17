<?php

namespace App\Image;

use App\Image\Imagick\Imagick;
use App\Storage\Local\TempStorageService;

class ImageService
{
    const DEFAULT_STICKER_WIDTH = 512;
    const DEFAULT_STICKER_HEIGHT = 512;

    public function resizeImage(
        string $source,
        int $width = self::DEFAULT_STICKER_WIDTH,
        int $height = self::DEFAULT_STICKER_HEIGHT
    )
    {
        $imageContent = base64_decode($source);
        $sourceImagePath = (new TempStorageService)->saveTempImage($imageContent);
        $resultImagePath = (new Imagick($sourceImagePath))->resize($width, $height);
        $resultContent = file_get_contents($resultImagePath);
        return base64_encode($resultContent);
    }
}
