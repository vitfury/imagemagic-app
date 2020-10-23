<?php

namespace App\Http\Controllers\Api;

use Faker\Provider\Image;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Storage\Local\TempStorageService;
use App\Image\Imagick\Imagick;
use App\Image\ImageService;
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
        if(empty($dimensions['width']) || empty($dimensions['height'])) {
            $dimensions['width'] = ImageService::DEFAULT_STICKER_WIDTH;
            $dimensions['height'] = ImageService::DEFAULT_STICKER_HEIGHT;
        }
        $resizedImage = (new ImageService)->resizeImage($image, $dimensions['width'], $dimensions['height']);
        return response()->json([
            'result' => true,
            'image' => $resizedImage
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeBackground(Request $request)
    {
        $image = $request->get('image');
        $resizedImage = (new ImageService)->resizeImage($image);
        $imageWithoutBackground = (new BackgroundWorker())->remove($resizedImage);
        $trimmedImage = (new ImageService())->trimImage($imageWithoutBackground);
        return response()->json(['result'=> true, 'image'=> $trimmedImage]);
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
