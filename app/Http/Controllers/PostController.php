<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::with(['category', 'tags'])->get();

        return response()->json(['status' => true, 'data' => $post]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'tag' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => $validate->errors()]);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();
        if (!empty($request->tag)) {
            $post->tags()->sync(explode(',', $request->tag));
        }

        return response()->json(['status' => true, 'message' =>  'Berhasil menambah post']);
    }

    public function detail($id)
    {
        $post = Post::with(['category', 'tags'])->where('id', $id)->first();
        return response()->json(['status' => 'success', 'data' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'tag' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['status' => 'error', 'message' => $validasi->errors()]);
        }
        $post = Post::where('id', $id)->first();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync(explode(',', $request->tag));

        return response()->json(['status' => true, 'message' =>  'Berhasil menambah post']);
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();

        $post->delete();

        return response()->json(['status' => 'success', 'data' => $post]);
    }
}
