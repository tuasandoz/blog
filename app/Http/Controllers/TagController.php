<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        $tag = Tag::get();

        return response()->json(['status' => true, 'data' => $tag]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => $validate->errors()]);
        }

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        return response()->json(['status' => true, 'message' =>  'Berhasil menambah tag']);
    }

    public function show($id)
    {
        $tag = Tag::where('id', $id)->first();
        return response()->json(['status' => 'success', 'data' => $tag]);
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['status' => 'error', 'message' => $validasi->errors()]);
        }

        $tag = Tag::where('id', $id)->first();
        $tag->name = $request->name;
        $tag->save();

        return response()->json(['status' => true, 'message' =>  'Berhasil mengubah tag']);
    }

    public function delete($id)
    {
        $tag = Tag::where('id', $id)->first();

        $tag->delete();

        return response()->json(['status' => 'success', 'data' => $tag]);
    }
}
