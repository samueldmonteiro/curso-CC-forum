<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Matter;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        //auth()->logout();

        //return response("FOI");

        return view('home', [
            'user' => auth()->user(),
            'matters' => Matter::all(),
            'topics' => Topic::orderByDesc('id')->get()
        ]);
    }
}
