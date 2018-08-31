<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = DB::table('posts')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
        $posts_all = Post::orderBy('created_at', 'desc')
                        ->paginate(5);
        return view('posts.index', ['posts' => $posts, 'new_posts' => $posts_all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
        ]);

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'body' => $request['body'],
        ]);
        return back()->with('status', 'Post added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $result = Post::find($post->id)->comments;
        $count = count(Post::find($post->id)->comments);
        $posts = Post::find($post->id);
        $author = User::find($post->user_id);
        return view('posts.show', ['comments' => $result, 'count' => $count], ['posts' => $posts , 'author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'body' => 'required:string',
        ]);

          /*DB::table('posts')
                    ->where('id', $post->id)
                    ->update([
                        'title' => $request->title,
                        'body'  => $request->body
                    ]);*/
        $postu = Post::find($post->id);
        $postu->title = $request->title;
        $postu->body = $request->body;
        $postu->save();
        return back()->with('status', 'Post edited successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        return redirect('posts')->with('status', 'post deleted');  
    }
}