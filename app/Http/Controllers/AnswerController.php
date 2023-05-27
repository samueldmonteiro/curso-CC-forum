<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Http\Requests\AnswerLikeRequest;
use App\Models\Answer;
use App\Models\Topic;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerRequest $request)
    {
        $topic = Topic::find($request->topic);

        $answer = new Answer();
        $answer->user_id = auth()->id();
        $answer->content = $request->content;
        $topic->answers()->save($answer);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnswerRequest $request)
    {
        Answer::destroy($request->answer);
        return message()->success('Sua reposta foi deletada!')->json();
    }

    public function like(AnswerLikeRequest $request)
    {
        $answer = Answer::find($request->answer);
        $answer->likeToggle();

        return response()->json(true);
    }
}
