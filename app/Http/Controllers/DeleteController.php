<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->route('login');
        }
        $user->delete();
        return view('deleted');
    }
}
