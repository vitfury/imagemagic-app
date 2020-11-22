<?php

namespace App\Entity;

use App\StickerModel as StickerModel;
use App\Storage\Local\StickersStorageService;

class Sticker
{
    /**
     * @var StickerModel;
     */
    public $model;

    /**
     * Sticker constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->model = StickerModel::findOrFail($id);
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->model->name;
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getImage()
    {
        return (new StickersStorageService())->getStickerImage($this->model->id);
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getJson()
    {
        return (new StickersStorageService())->getStickerJson($this->model->id);
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getPreview()
    {
        return (new StickersStorageService())->getStickerPreview($this->model->id);
    }

    /**
     * @param string $content
     * @return bool
     */
    public function saveImage(string $content) :bool
    {
        return (new StickersStorageService())->saveStickerImage($this->model->id, $content);
    }

    /**
     * @param $content
     * @return bool
     */
    public function saveJson($content) :bool
    {
        return (new StickersStorageService())->saveStickerJson($this->model->id, $content);
    }

    /**
     * @param $content
     * @return bool
     */
    public function savePreview($content) :bool
    {
        return (new StickersStorageService())->saveStickerPreview($this->model->id, $content);
    }
}
