<?php
//タスク

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
//use Log;

//
class TasksController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index()
    {
//var_dump("#index");
//exit();
        $tasks = Task::orderBy('updated_at', 'desc')->get();
        return view('tasks/index')->with('tasks', $tasks);
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('tasks/create')->with('task', new Task());
    }
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
//debug_dump( $request->all() );
//exit();
        $task = new Task();
        $task->fill($request->all());
        $task->save();
        return redirect()->route('tasks.index');
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks/show')->with('task', $task);
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks/edit')->with('task', $task);
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->fill($request->all());
        $task->save();
        return redirect()->route('tasks.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }    


}
