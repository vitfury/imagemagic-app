<?php

namespace App\Storage\Local;

use Illuminate\Support\Facades\Storage;

class StickersStorageService
{
    private $storage;
    public function __construct()
    {
        $this->storage = Storage::disk('volume');
    }

    /**
     * @param int $stickerId
     * @param string $content
     */
    public function saveStickerImage(int $stickerId, string $content)
    {
        $filePath = "$stickerId/image.png";
        return $this->storage->put($filePath, $content);
    }

    /**
     * @param int $stickerId
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getStickerImage(int $stickerId)
    {
        $filePath = "$stickerId/image.png";
        return $this->storage->get($filePath);
    }

    /**
     * @param $stickerId
     * @param $json
     * @return bool
     */
    public function saveStickerJson($stickerId, $json)
    {
        $filePath = "$stickerId/object.json";
        return $this->storage->put($filePath, $json);
    }

    /**
     * @param $stickerId
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getStickerJson($stickerId)
    {
        $filePath = "$stickerId/object.json";
        return $this->storage->get($filePath);
    }

    /**
     * @param $stickerId
     * @param $content
     * @return bool
     */
    public function saveStickerPreview($stickerId, $content)
    {
        $filePath = "$stickerId/preview.png";
        return $this->storage->put($filePath, $content);
    }

    /**
     * @param $stickerId
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getStickerPreview($stickerId)
    {
        $filePath = "$stickerId/preview.png";
        return $this->storage->get($filePath);
    }

    public function deleteSticker($stickerId)
    {
        $this->storage->delete($stickerId);
    }

}
