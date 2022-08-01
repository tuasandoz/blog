<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::with(['posts'])->get();

        // return response()->json(['status' => true, 'data' => $categories]);
        return CategoryResource::collection(Category::get());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => $validate->errors()]);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json(['status' => true, 'message' =>  'Berhasil menambah categori']);
    }

    public function detail($id)
    {
        $category =Category::where('id', $id)->first();
        return response()->json(['status' => 'success', 'data' => $category]);
    }

    public function update(Request $request, $id)
    { 
           $validasi = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['status' => 'error', 'message' => $validasi->errors()]);
        }
        $category = Category::where('id', $id)->first();
        $category->name = $request->name;
        $category->save();

        return response()->json(['status' => true, 'message' =>  'Berhasil mengubah category']);
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->first();

        $category->delete();

        return response()->json(['status' => 'success', 'data' => $category]);
    }
}
