<?php

namespace App\Http\Controllers\Api;

use App\Entity\Sticker;
use App\Entity\StickerDTO;
use App\StickerModel;
use App\StickerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class StickerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * @param Request $request
     * @param $stickerId
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $stickerId)
    {
        try {
            $user = $request->user();
            $sticker = (new Sticker($stickerId));
            return response()->json([
                'result'=> true,
                'data' => [
                    'name' => $sticker->getName(),
                    'json' => $sticker->getJson()
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response('Not Found', 404);
        } catch (FileNotFoundException $e) {
            return response('Not Found', 404);
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
//        try {
            $user = $request->user();
            $request->validate(
                [
                    'name' => 'required',
                    'image' => 'required',
                    'json' => 'required'
                ]
            );
            $name = $request->get('name');

            $stickerModel = (new StickerModel([
                 'name' => $name,
                 'user_id' => $user->id
            ]));
            $stickerModel->save();

            $sticker = (new Sticker($stickerModel->id));
            $stickerDTO = (new StickerDTO($request->get('image'), $request->get('json')));
            (new StickerService())->updateSticker($sticker, $stickerDTO);
            return response()->json(
                [
                    'result'=> true,
                    'data' => [
                        'id' => $stickerModel->id
                    ]
                ]
            );
//        } catch (\Throwable $e) {
//            dd($e->getMessage());
//        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request, $stickerId)
    {
        $user = $request->user();
        $request->validate([
            'image' => 'required',
        ]);
        $sticker = (new Sticker($stickerId));
        $stickerDTO = (new StickerDTO($request->get('image'), $request->get('json')));
        (new StickerService())->updateSticker($sticker, $stickerDTO);

        return response()->json(['result'=>true]);
    }
}
