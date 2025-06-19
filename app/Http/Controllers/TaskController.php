<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        if ($this->permission ('admin'))
        {    
            $tasks = Task::latest()
            ->when(request()->search, function($query){
                $query->where(function($query){
                    $search = request()->search;
                    $query->where('tasks', 'like', "%$search%");
                });
            })
            ->paginate(10);

            return view('tasks.index', [
                'tasks' => $tasks,
            ]);
        }
        return abort(403);
    }

    public function create()
    {   
        if ($this->permission ('admin'))
        {    
            $users = \App\Models\User::get();

            return view('tasks.create' , ['users' => $users]);
        }
        return abort(403);
    }

    //to show result from form create
    public function store(Request $request)
    {
        if ($this->permission ('admin'))
        {    
            //validation
            $request->validate([
                'user_id' => ['required'], 
                'tasks' => ['required'],
            ]);

            //store validated data
            $validated = [
            'user_id' => $request->user_id,
            'tasks' => $request->tasks,
            ];

            //store data to database
            Task::create($validated);

            //redirect to page
            return redirect ('/tasks')->with ('success','Task has been made!');
        }
        return abort(403);

    }

    //gatau ini dipake atau engga, soalnya buat ulang di inLineUpdate,
    //keep aja utk jaga jaga, idk
    public function dashboardstore(Request $request)
    {
        //validation
        $request->validate([
            'tasks' => ['required'],
        ]);

        //store validated data
        $validated = [
        'user_id' => auth()->id(),
        'tasks' => $request->tasks,
        ];

        //store data to database
        $task = Task::create($validated);

        //redirect to page
        return response()->json($task);

    }

    //to show edit form
    public function edit($id)
    {
        if ($this->permission ('admin'))
        {    
            $tasks = Task::find($id);
            $users = \App\Models\User::get();

            return view('tasks.edit', ['tasks' => $tasks, 'users' => $users]);
        }
        return abort(403);
        
    }


    //admin mode update
    public function update(Request $request, $id)
    {
        if ($this->permission ('admin'))
        {    
            $validated = $request->validate([
                'tasks' => ['required'],
            ]);
            Task::find($id)->update($validated);

            return redirect ('/tasks')->with ('success','Task has been updated!');
        }
        return abort(403);
    }
 
    //user mode update
    public function inlineUpdate(Request $request, $id)
    {
        $request->validate([
            'tasks' => 'required|string|max:255'
        ]);

        $task = Task::findOrFail($id);
        
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->tasks = $request->tasks;
        $task->save();

        return response()->json(['message' => 'Task updated.']);
    }

    //admin mode destroy
    public function destroy($id)
    {
        if ($this->permission ('admin'))
        {
            Task::destroy($id);

            return redirect ('/tasks')->with('success','Task has been deleted!');
        }
        return abort(403);
    }


    //dashboard destroy
    public function ddestroy($id)
    {   
        $task = Task::findOrFail($id);

        if ($task->user_id === auth()->id())
        {
            Task::destroy($id);

            return redirect ('/dashboard');
        }
        return abort(403);
            
    }
    
    


}
