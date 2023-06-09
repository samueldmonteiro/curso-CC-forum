<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;
use Mews\Purifier\Purifier as PurifierPurifier;
use voku\helper\AntiXSS;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $x = new AntiXSS();
        echo $x->xss_clean('<p>Hello, orld!</p>\n<p><span style="text-decoration: underline;">uhuhuuhuhu</span></p>\n<p>&nbsp;</p>\n<table style="border-collapse: collapse; width: 100%;" border="1"><colgroup><col style="width: 16.6265%;"><col style="width: 16.6265%;"><col style="width: 16.6265%;"><col style="width: 16.6265%;"><col style="width: 16.6265%;"><col style="width: 16.6265%;"></colgroup>\n<tbody>\n<tr>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n<tr>\n<td>&nbsp;</td>\n<td>\n<p>ijih4i3ht4t</p>\n<p>34ti4tj34j3</p>\n</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n<tr>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n<tr>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n<tr>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>');
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
    public function store(Request $request)
    {
        if (in_array('', $request->all())) {
            return message()->warning('Preecha todos os campos!')->json();
        }

        $matter = Matter::find($request->category);
        if (!$matter) {
            return message()->error('Erro ao encontrar a matéria selecionada; Tente novamente!')->json();
        }

        $xss = new AntiXSS();
        $content = $request->content;
        if ($xss->isXssFound($content)) {
            $xss->removeEvilAttributes(array('style'));
            $content = $xss->xss_clean($content);
        }

        $topic = new Topic();
        $topic->generateUri();
        $topic->user_id = auth()->id();
        $topic->matter_id = $request->category;
        $topic->fill($request->all());
        $topic->save();

        return message()->info('Tópico Publicado!')->more([
            'redirect' => route('home'),
        ])->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $topic)
    {

        $topic = Topic::where('uri', $topic)->firstOrFail();

        $head = $this->seo->render(
            env('APP_NAME') . ' | Tópico - ' . $topic->title,
            'Bem vindo ao fórum do curso de Ciência da Computação!',
            route('topics.show', ['topic' => $topic->uri]),
            ''
        );

        return view('topics.show', compact('topic', 'head'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        if (auth()->id() !== $topic->user_id) {
            return response()->json('Permission denied', 422);
        }
        $topic->delete();
        return message()->success('Tópico removido!')->json();
    }

    public function state(Topic $topic)
    {
        if (auth()->id() !== $topic->user_id) {
            return response()->json(['error' => 'Erro ao efetuar ação!'], 422);
        }

        $topic->stateToggle();
        session()->flash('message', 'Estado do tópico atualizado!');
        return message()->success('Ação confirmada!')->json();
    }
}
