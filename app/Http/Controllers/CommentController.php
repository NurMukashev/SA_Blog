<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        //dd($request);
        $comment = new Comment();
        $comment->post_id = 150; //$request->post_id; не успел настроить передачу с фронта
        $comment->user_id = Auth::user();
        $comment->text = $request->text;

        $success = $comment->save();

        var_dump($success);

        if($success){
            return response('Комментарий добавлен', 200);
        }else{
            return response('Комментарий не добавлен', 403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
