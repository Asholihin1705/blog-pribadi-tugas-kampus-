<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    //menampilkan semua data
    public function index(){
        $data = Category::get();
        return view('admin.category.index', compact('data'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function insert(Request $request){
        $request->validate(Category::$rules);
        $requests = $request->all();
        $requests['iamge'] = "";

        if($request->hasFile('image')){
            $files = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/category/", $files);
            $requests['image'] = "file/category/" . $files;
        }

        $cat = Category::create($requests);
        if($cat){
            return redirect('admin/category')->with('status', 'Berhasil menambahkan data');
        }

        return redirect ('admin/category')->with('status', 'Gagal menambahkan data');
    }

}
