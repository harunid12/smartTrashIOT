<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        return view('user.profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id,
            'password' => ($request->filled('password')) ? 'max:255|min:7' : 'nullable',
        ]);

        // jika mengganti password dan keseluruhan data
        if ($request['password']){
            $password = Hash::make($request->password);
            
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password
            ]);
        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        
        return back()->with('toast_success', 'data profile berhasil diubah');
    }
}
