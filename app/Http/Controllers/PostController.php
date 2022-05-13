<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(10);
    
        return view('post')->with(compact('posts'));
    }

    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect('post');
    }

    public function edit(Request $request, $id)
    {
        
        $post = Post::find($id);
        $post->status = $request->post('action');
        $post->save();     

        return redirect('post');
    }

    public function destroy(Post $post,$id)
    {
        $post = Post::find($id);
        $post->delete();
        
        return redirect('post');
    }
}
