<?php

namespace App\Storage\Local;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

class TempStorageService
{

    const TEMP_SOURCE_IMAGES_PATH = '/temp/source/';
    const TEMP_RESIZED_IMAGES_PATH = '/temp/resized/';
    const TEMP_UNBACKGROUNDED_IMAGES_PATH = '/temp/unbackgrounded/';

    public function clearTempLocalStorage()
    {
        $filesystem = (new Filesystem);
        $tempFolders = [];

        foreach([
                storage_path().self::TEMP_SOURCE_IMAGES_PATH,
                storage_path().self::TEMP_RESIZED_IMAGES_PATH,
                storage_path().self::TEMP_UNBACKGROUNDED_IMAGES_PATH,
            ] as $folder)
        {
            if($filesystem->exists($folder)) {
                $tempFolders = array_merge(
                    $filesystem->directories($folder),
                    $tempFolders
                );
            }
        }

        foreach ($tempFolders as $folder) {
            if (time() - $filesystem->lastModified((string)$folder) > 120) {
                $filesystem->deleteDirectory((string)$folder);
            }
        }
    }

    private function createIfNotExist($folderPath)
    {
        $filesystem = (new Filesystem);
        if (!$filesystem->exists($folderPath)) {
            if (!$filesystem->makeDirectory($folderPath, 0777, true))
            {
                throw new LocalStorageException('Failed to create temporary directory - ' . $folderPath);
            }
        }
    }

    public function saveTempImage(string $content)
    {
        $folderPath = storage_path().self::TEMP_SOURCE_IMAGES_PATH . $this->getCurrentTempFolder();
        $this->createIfNotExist($folderPath);
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $this->generateFilename() . '.png';
        (new Filesystem)->put($filePath, $content);
        return $filePath;
    }

    public function saveUnbackgroundedImage($content)
    {
        $folderPath = storage_path().self::TEMP_UNBACKGROUNDED_IMAGES_PATH . $this->getCurrentTempFolder();
        $this->createIfNotExist($folderPath);
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $this->generateFilename() . '.png';
        (new Filesystem)->put($filePath, $content);
        return $filePath;
    }

    public function saveResizedImage($content, $extension)
    {
        $folderPath = storage_path().self::TEMP_RESIZED_IMAGES_PATH . $this->getCurrentTempFolder();
        $this->createIfNotExist($folderPath);
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $this->generateFilename()  . ".$extension";
        (new Filesystem)->put($filePath, $content);
        return $filePath;
    }

    public function getUnbackgroundedImagePath($filename)
    {
        $folderPath = storage_path().self::TEMP_UNBACKGROUNDED_IMAGES_PATH . $this->getCurrentTempFolder();
        $this->createIfNotExist($folderPath);
        return $folderPath . DIRECTORY_SEPARATOR . $filename;
    }

    public function getResizedImagePath($filename)
    {
        $folderPath = storage_path().self::TEMP_RESIZED_IMAGES_PATH . $this->getCurrentTempFolder();
        $this->createIfNotExist($folderPath);
        return $folderPath . DIRECTORY_SEPARATOR . $filename;
    }

    /**
     * @param $filePath
     * @throws LocalStorageException
     */
    public function checkResultFile($filePath)
    {
        if(!file_exists($filePath)) {
            throw new LocalStorageException('File does not exist after conversion');
        }
        if(filesize($filePath) === 0) {
            throw new LocalStorageException('Empty file after conversion');
        }
    }

    private function getCurrentTempFolder()
    {
        return Carbon::now()->format('Y-m-d_H-i');
    }

    public function generateFilename()
    {
        return md5(microtime());
    }
}
