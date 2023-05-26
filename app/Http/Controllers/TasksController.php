<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        // メッセージ一覧を取得
        $tasks = Task::all();        

        // メッセージ一覧ビューでそれを表示
        return view('tasks.index', [     
            'tasks' => $tasks,        
        ]);                                 
    }

    public function create()
    {
        $task = new Task;
        return view('tasks.create', ['task' => $task, ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|max:255',  
            'content' => 'required|max:255',
            'status' => 'gte:field'
        ]);
        
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        return redirect('/');
    }
    
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|max:255',  
            'content' => 'required|max:255',
        ]);
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/');
    }
}
