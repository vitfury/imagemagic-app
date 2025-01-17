<?php

namespace App\Image\Imagick;

use App\Storage\Local\TempStorageService;

class Imagick
{
    private $imagePath;

    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function resize($width, $height)
    {
        $image = new \Imagick($this->imagePath);

        $extension = $image->getImageFormat();
        $image->thumbnailImage($width, $height, true, false);
        header("Content-Type: image/$extension");
        $resizedImageContent = $image->getImageBlob();

        return (new TempStorageService())->saveResizedImage($resizedImageContent, strtolower($extension));
    }

    public function trim()
    {
        $image = new \Imagick($this->imagePath);

        $extension = $image->getImageFormat();
        $image->trimImage(100);
        header("Content-Type: image/$extension");
        $resizedImageContent = $image->getImageBlob();

        return (new TempStorageService())->saveResizedImage($resizedImageContent, strtolower($extension));
    }
}
