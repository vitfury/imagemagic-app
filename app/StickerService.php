<?php

namespace App;

use App\Entity\Sticker;
use App\Entity\StickerDTO;
use App\Image\ImageService;

class StickerService
{
    /**
     * @param Sticker $sticker
     * @param StickerDTO $DTO
     */
    public function updateSticker(Sticker $sticker, StickerDTO $DTO)
    {
        $sticker->saveImage($DTO->getImage());
        $sticker->saveJson($DTO->getJson());
        $sticker->savePreview(
            (new ImageService())->generatePreview(
                $sticker->getImage()
            )
        );
    }
}
