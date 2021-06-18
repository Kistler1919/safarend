<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Post;
use Illuminate\Support\Str;
use App\Helpers\MiscHelpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected $miscHelpers;

    public function __construct(MiscHelpers $miscHelpers)
    {
        $this->miscHelpers = $miscHelpers;
    }
    
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $fields = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $identifier = $this->miscHelpers->IDGenerator(new Post, 'identifier', 8, 'KXY');
        $slug = Str::slug($fields['title'], '-');

        $post = Post::create([
            'user_id' => $userId,
            'title' => $fields['title'],
            'content' => $fields['content'],
            'identifier' => $identifier,
            'slug' => $slug
        ]);

        // $post->save();
        
        return $post;
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        // $userId = Auth::user()->id;
        // dd($request);

        $data = array();
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        $slug = Str::slug($data['title'], '-');

        $data['slug'] = $slug;

        // dd($data);

        $post = Post::where('id', $id)->update($data);
        
        return $post;
    }

    public function destroy($id)
    {
        Post::where('id', $id)->first()->delete();
        return response()->json("Post deleted!");
    }
}
