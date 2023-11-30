<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('layouts.datatable', compact('users'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Assets/images/profile_picture'), $filename);

            $user = User::find(Auth::id());
            $user->profile_picture = $filename;
            $user->save();
        }

        return redirect()->back();
    }

}
