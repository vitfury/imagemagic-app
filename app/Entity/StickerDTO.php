<?php

namespace App\Entity;

class StickerDTO
{

    /**
     * @var string
     */
    private $json;

    /**
     * @var string
     */
    private $image;

    /**
     * StickerTransferObject constructor.
     * @param string $stickerContent
     */
    public function __construct(string $image, string $json)
    {
        $this->image = base64_decode($image);
        $this->json = $json;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }
}
