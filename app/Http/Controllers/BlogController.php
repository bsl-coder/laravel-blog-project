<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return view('dashboard.blog.index',compact('blogs'));
    }
    public function view_create(){
        $categories = Category::all();
        return view('dashboard.blog.create',[
            'categories' => $categories
        ]);
    }
    public function create(Request $request){

        $request->validate([

            'title' => 'required',
            'image' => 'required|image',
            'category_id' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);

        $new_name = auth()->id().'-'.$request->title.'.'.$request->file('image')->getClientOriginalExtension();
        $img = Image::make($request->file('image'))->resize(300, 200);
        $img->save(base_path('public/uploads/blog/'.$new_name), 60);

        if($request->hasFile('image')){
            Blog::insert([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'image' => $new_name,
                'created_at' => now(),
            ]);
            return redirect()->route('blog')->with('blog_success','Blog insert successful');
        }

    }
}
