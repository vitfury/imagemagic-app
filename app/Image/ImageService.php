<?php

namespace App\Image;

use App\Image\Imagick\Imagick;
use App\Storage\Local\TempStorageService;

class ImageService
{
    const DEFAULT_STICKER_WIDTH = 512;
    const DEFAULT_STICKER_HEIGHT = 512;

    const DEFAULT_PRERVIEW_WIDTH = 96;
    const DEFAULT_PREVIEW_HEIGHT = 96;

    public function resizeImage(
        string $source,
        int $width = self::DEFAULT_STICKER_WIDTH,
        int $height = self::DEFAULT_STICKER_HEIGHT
    )
    {
        $imageContent = $source;
        $sourceImagePath = (new TempStorageService)->saveTempImage($imageContent);
        $resultImagePath = (new Imagick($sourceImagePath))->resize($width, $height);
        $resultContent = file_get_contents($resultImagePath);
        return $resultContent;
    }

    public function trimImage(string $source) :string
    {
        $imageContent = base64_decode($source);
        $sourceImagePath = (new TempStorageService)->saveTempImage($imageContent);
        $resultImagePath = (new Imagick($sourceImagePath))->trim();
        $resultContent = file_get_contents($resultImagePath);
        return base64_encode($resultContent);
    }

    public function generatePreview(string $soure)
    {
        return $this->resizeImage($soure, self::DEFAULT_PRERVIEW_WIDTH, self::DEFAULT_PREVIEW_HEIGHT);
    }
}
