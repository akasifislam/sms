<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function view()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.profile.view-profile',compact('user'));
    }
    public function edit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.profile.edit-profile',compact('editData'));
    }

    public function update(Request $request)
    {
        $data =  User::find(Auth::user()->id);
        $data->gender = $request->gender;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_image/'.$data->image));
            $filename =  date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['image']= $filename;
        }
        $data->save();
        return redirect()->route('profiles.view')->with('success','Data Updated');
    }

    public function passwordView()
    {
        return view('backend.profile.edit-password');
    }
    public function passwordUpdate(Request $request)
    {
        if (Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->current_password])) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('profiles.view')->with('success','successfully updated');
        }else{
            return redirect()->back()->with('fdfg','dsfdsfgsdg');
        }
    }










}
