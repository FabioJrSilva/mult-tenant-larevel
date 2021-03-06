<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    private $comment;

    public function __construct(Comments $comment)
    {
        $this->comment = $comment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->comment == null) {
            return back()->withErrors('Erro ao criar o comentário!');
        }

        $comment = $request->all();
        $comment['user_id'] = auth()->user()->id;
        Comments::create($comment);

        return back()->withSuccess('Comentário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->comment) {
            return redirect()
                ->back()
                ->withErrors('O comentário não pode estar vazio!');
        }

        $comment = $this->comment->find($id);
        $comment->update($request->all());
        return redirect()->back()->withSuccess('Comentário Atualizado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->comment->find($id);
        $comment->delete();

        return redirect()
            ->back()
            ->withSuccess('Deletado com sucesso!');
    }
}
