<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller

{   
    public function index($id)
    {
        $usercheck = User::findOrFail($id);

        if ($usercheck->id === auth()->id())
        {
            $user = \App\Models\User::find($id);

            return redirect("/profile" . auth()->user()->id, ['user' => $user]);
        }
        return abort(403);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        if ($user->id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', "unique:users,email,$user->id"],
            'password' => ['nullable'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update(['password' => $request->password]);
        }

        return redirect ('/profile/' . auth()->user()->id)->with ('success','User has been stored!');
    }

    public function destroy(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if ($user->id !== auth()->id()) {
            abort(403);
        }

        User::destroy($id);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
