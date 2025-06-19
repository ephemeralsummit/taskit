<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index(){
        if ($this->permission ('admin')){
            $users = User::latest()
            ->when(request()->search, function($query){
                $query->where(function($query){
                    $search = request()->search;
                    $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
                });
            })
            
            ->paginate(10);

            return view('users.index', [
                'users' => $users,
            ]);
        }
        return abort(403);
    }

    public function create(){
        if ($this->permission ('admin')){
            return view('users.create');
        }

        return abort(403);
    }

    public function show($id){
        if ($this->permission ('admin')){
            $user = User::find($id);
            return view('users.show', ['user' => $user]);
        }
        return abort(403);
    }

    public function store (Request $request){
        if ($this->permission ('admin')){
            $request->validate([
                'name' => ['required', 'min:5', 'max:100'],
                'email' => ['required', 'unique:users,email', 'max:100'],
                'password' => ['required', 'min:3'],
            ]);

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;

            User::create ([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect ('/users')->with ('success','User has been stored!');
        }
        return abort(403);
    }

    public function edit($id) {

        if ($this->permission ('admin')){

            $user = User::find($id);

            $roles = Role::get();

            return view('users.edit', ['user' => $user, 'roles' => $roles]);
        }

        return abort(403);
    }

    public function update(Request $request, $id) {
        if ($this->permission ('admin')){

            $user = User::find($id);

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

            if ($request->role_id){
                $user->update(['role_id' => $request->role_id]);
            }

            return redirect ('/users')->with ('success','User has been updated!');
        }

        return abort(403);
    }

    

    public function destroy($id){
        if ($this->permission ('admin')){

            User::destroy($id);
            return redirect ('/users')->with('success','User has deleted!');    
        }
        return abort(403);
        
    }
}
