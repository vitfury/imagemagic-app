<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Storage\Local\TempStorageService;
use App\Image\Imagick\Imagick;
use App\Image\BackgroundWorker;

class ImageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resize(Request $request)
    {
        $image = $request->get('image');
        $dimensions = $request->get('dimensions');
        $width = $dimensions['width'];
        $height = $dimensions['height'];
        $imageContent = base64_decode($image);
        $sourceImagePath = (new TempStorageService)->saveTempImage($imageContent);
        $resultImagePath = (new Imagick($sourceImagePath))->resize($width, $height);
        $resultContent = file_get_contents($resultImagePath);
        return response()->json([
            'result' => true,
            'image' => base64_encode($resultContent)
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeBackground(Request $request)
    {
        $image = $request->get('image');
        $encodedImage = (new BackgroundWorker())->remove($image);
        $unbackgroundedImagePath = (new TempStorageService())->saveUnbackgroundedImage(base64_decode($encodedImage));
        return response()->json(['result'=> true, 'image'=> $encodedImage]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeBackgroundBinary(Request $request)
    {
        $image = $request->all();
        $imagePathName = $image['image']->getPathName();
        $encodedImage = (new BackgroundWorker())->remove(base64_encode(file_get_contents($imagePathName)));
        $unbackgroundedImagePath = (new TempStorageService())->saveUnbackgroundedImage(base64_decode($encodedImage));
        return response()->json(['result'=> true, 'image'=> $encodedImage]);
    }
}
