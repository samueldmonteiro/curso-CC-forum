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
        return view('home', [
            'user' => auth()->user(),
            'matters' => Matter::all(),
            'topics' => Topic::orderByDesc('id')->get()
        ]);
    }

    public function searchTopics(Request $request)
    {
        $search = $request->search;
        $topics = Topic::where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->get();

        return view('home', [
            'user' => auth()->user(),
            'matters' => Matter::all(),
            'topics' => $topics
        ]);
    }

    public function topicsByMatter(Request $request, string $matter)
    {

        $matter = Matter::where('uri', $request->matter)->first();
        if (!$matter) return redirect()->route('home');

        return view('home', [
            'user' => auth()->user(),
            'matters' => Matter::all(),
            'topics' => $matter->topics()->get()
        ]);
    }
}
