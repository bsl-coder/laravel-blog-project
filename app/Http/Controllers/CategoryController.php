<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(2);
        return view('dashboard.category.index',compact('categories'));
    }
    public function insert(Request $request){
        $request->validate([

            'title' => 'required',
            'image' => 'required|image',
        ]);

        $new_name = auth()->id().'-'.$request->title.'.'.$request->file('image')->getClientOriginalExtension();
        $img = Image::make($request->file('image'))->resize(300, 200);
        $img->save(base_path('public/uploads/category/'.$new_name), 60);

        if($request->hasFile('image')){
            if($request->slug){
                Category::insert([
                    'image' => $new_name,
                    'title' => $request->title,
                    'slug' => str::slug($request->slug),
                    'created_at' => now(),
                ]);
            }else{
                Category::insert([
                    'image' => $new_name,
                    'title' => $request->title,
                    'slug' => str::slug($request->title),
                    'created_at' => now(),
                ]);
            }

            return back()->with('category_success','Category insert successful');
        }
    }

    public function delete($id){
        Category::find($id)->delete();
        return back()->with('category_success','Category delete successful');

    }

    public function edit(Request $request,$id){
        $request->validate([

            'title' => 'required',

        ]);


        if($request->hasFile('image')){

            $category = Category::where('id',$id)->first();

            unlink(public_path('uploads/category/'.$category->image));

            $new_name = $id.'-'.$request->title.'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(300, 200);
            $img->save(base_path('public/uploads/category/'.$new_name), 60);

            if($request->slug){
                Category::find($id)->update([
                    'image' => $new_name,
                    'title' => $request->title,
                    'slug' => str::slug($request->slug),
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category update successful');
            }else{
                Category::find($id)->update([
                    'image' => $new_name,
                    'title' => $request->title,
                    'slug' => str::slug($request->title),
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category update successful');
            }


        }else{
            if($request->slug){
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => str::slug($request->slug),
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category update successful');
            }else{
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => str::slug($request->title),
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category update successful');
            }
        }
    }

    public function status_change($id){
        $category = Category::where('id',$id)->first();

        if($category->status == 'active'){
            Category::find($id)->update([
                'status' => 'deactive',
                'created_at' => now(),
            ]);
            return back()->with('category_success','Category deactive successful');

        }else{
            Category::find($id)->update([
                'status' => 'active',
                'created_at' => now(),
            ]);
            return back()->with('category_success','Category active successful');

        }
    }
}
