<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function index()
    {
        if ($this->permission ('admin')){
            $roles = Role::latest()
            ->when(request()->search, function($query){
                $query->where(function($query){
                    $search = request()->search;
                    $query->where('name', 'like', "%$search%");
                });
            })
            ->paginate(10);

            return view('roles.index', ['roles' => $roles]);
        }
        return abort(403);
    }

    public function create()
    {
        if ($this->permission ('admin')){
            return view('roles.create');
        }
        return abort(403);
    }

    public function store(Request $request)
    {
        if ($this->permission ('admin')){
            $validated = $request->validate([
                'name'=> 'required',   
            ]);

            Role::create($validated);

            return redirect('roles')->with('success','Data has been stored!');
        }
        return abort(403);
    }

    public function edit($id)
    {
        if ($this->permission ('admin')){
            $role = Role::find($id);

            return view('roles.edit', ['role'=> $role]);
        }
        return abort(403);
    }

    public function update(Request $request, $id)
    {
        if ($this->permission ('admin')){
            $validated = $request->validate([
                'name'=> 'required',
                ]);
            Role::find($id)->update($validated);
            return redirect('/roles')->with('success','Data has been updated!');
        }
        return abort(403);
    }

    public function destroy($id)
    {
        if ($this->permission ('admin')){
            Role::destroy($id);

            return redirect('/roles')->with('success','Data has been deleted!');
        }
        return abort(403);
    }
}
