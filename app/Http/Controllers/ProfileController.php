<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }
    public function name_update(Request $request, $id){
        $request->validate([

            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:50',
        ]);

        User::find($id)->update([
            'name' => $request->name,
            'created_at' => now(),
        ]);
        return back()->with('update_success','Name update successful');
    }
    public function email_update(Request $request, $id){
        $request->validate([

            'email' => 'required|email:rfc,dns',
        ]);

        User::find($id)->update([
            'email' => $request->email,
            'created_at' => now(),
        ]);
        return back()->with('update_success','Email update successful');
    }

    public function password_update(Request $request, $id){
        $request->validate([

            'current_password' => 'required',
            'password' => 'required|confirmed|min:6|max:10|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        if($request->current_password !== $request->password){
            if(Hash::check($request->current_password, auth()->user()->password)){
                User::find($id)->update([
                    'password' => $request->password,
                    'created_at' => now(),
                ]);
                return back()->with('update_success','Your password update is successful.');
            }
        }else{
            return back()->with('update_error',"You can't use old password.");
         }
    }





    public function image_update(Request $request, $id){
        $request->validate([

            'image' => 'required|image',
        ]);

        $new_name = auth()->id().'-'.auth()->user()->name.'.'.$request->file('image')->getClientOriginalExtension();
        $img = Image::make($request->file('image'))->resize(300, 200);
        $img->save(base_path('public/uploads/profile/'.$new_name), 60);

        User::find($id)->update([
            'image' => $new_name,
            'created_at' => now(),
        ]);

        return back();
    }




}
