<?php

namespace App\Http\Controllers;

use App\Entity\Sticker;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('editor');
    }

    public function edit($id)
    {
        $sticker = (new Sticker($id));
        return view(
            'editor',
            [
                'id' => $id,
                'json' => $sticker->getJson()
            ]
        );
    }
}
