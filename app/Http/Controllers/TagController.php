<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;



class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(3);
        $trashed = Tag::onlyTrashed()->get();
        return view('dashboard.tag.index',compact('tags','trashed'));
    }

    public function insert(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        Tag::insert([
            'title' => $request->title,
            'created_at' => now(),
        ]);
        return back();
    }

    public function delete($id){
        Tag::find($id)->delete();
        return back()->with('tag_success','Tag delete successful');
    }
    public function edit(Request $request,$id){
        $request->validate([
            'title' => 'required',
        ]);

        Tag::find($id)->update([
            'title' => $request->title,
        ]);

        return back()->with('tag_success','Tag Update successful');

    }

    public function status_change($id){
        $tag = Tag::where('id',$id)->first();

        if($tag->status == 'active'){
            Tag::find($id)->update([
                'status' => 'deactive',
                'created_at' => now(),
            ]);
            return back()->with('tag_success','Tag deactive successful');

        }else{
            Tag::find($id)->update([
                'status' => 'active',
                'created_at' => now(),
            ]);
            return back()->with('tag_success','Tag active successful');

        }
    }
    public function restore($id){
        Tag::withTrashed()->where('id',$id)->restore();

        return back()->with('tag_success','Tag restore successful');
    }
    public function forced_delete($id){
        Tag::withTrashed()->where('id',$id)->forceDelete();

        return back()->with('tag_success','Tag permanently delete successful');
    }


}
