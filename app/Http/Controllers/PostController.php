<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Requests\PostRequest;
use App\Models\Category;


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
                ->paginate(15)
                ->withQueryString()
                ->through(fn($post)=>[
                    'id' => $post->id,
                    'category' =>$post->category->name,
                    'author' => $post->user->name,
                    'title' => $post->title,
                    'text' => $post->text,
                    'created_at' => $post->created_at
                ]),
            'filters' => Request::only(['search'])
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

        return to_route('posts')->with('message', 'Пост добавлен');

        //dd($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('Posts/Edit', compact($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
