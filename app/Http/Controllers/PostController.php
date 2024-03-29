<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Posts/Index', [
            'posts' => Post::query()
                ->when(Request::input('search'), function($query, $search){
                    $query->where('title', 'like', "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->withQueryString()
                ->map(fn($post)=>[
                    'id' => $post->id,
                    'category' =>$post->category->name,
                    'author' => $post->user->name,
                    'user_id' => $post->user_id,
                    'title' => $post->title,
                    'text' => $post->text,
                    'created_at' => $post->created_at
                ]),
            'filters' => Request::only(['search']),
            'current_user' => Auth::id()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return inertia('Posts/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        $post->category_id = $request->category_id;

        if(Auth::check()){
            $post->user_id = Auth::id();
        }

        $post->save();

        return to_route('posts.index')->with('message', 'Пост добавлен');

        //dd($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = 1;

        return Inertia::render('Posts/Show', [
            'post' => $post,
            'post_author' => $post->user ? $post->user->name : null,
            'post_category' => $post->category ? $post->category->name : null,
            'comments' => Comment::where('post_id', $post->id)
                ->orderBy('id', 'desc')
                ->get()
                ->map(fn($comment)=>[
                    'id' => $comment->id,
                    'author' => $comment->user->name,
                    'text' => $comment->text,
                    'created_at' => $comment->created_at,
                ]),
            'auth_user' => Auth::user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if(Gate::denies('update-post', $post)){
            return to_route('posts.index')->with('message', 'У вас нет прав');
        }

        $categories = Category::all();
        return Inertia::render('Posts/Edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        //dd($request);

        $post->title = $request->title;
        $post->text = $request->text;
        $post->category_id = $request->category_id;

        $success = $post->save();

        if($success){
            return to_route('posts.index')->with('message', 'Пост обновлен');
        }else{
            return to_route('posts.index')->with('message', 'Не удалось обновить пост');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('destroy-post')){

            return to_route('posts.index')->with('message', 'У вас нет прав');

        }

        $success = $post->delete();

        if($success){
            return to_route('posts.index')->with('message', 'Пост удален');
        }else{
            return to_route('posts.index')->with('message', 'Невозможно удалить пост');
        }
    }
}
