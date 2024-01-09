<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Validator;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('updated_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    public function add()
    {
        return view('tasks.add');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/tasks/add')->withInput()->withErrors($validator);
        }
        $task = new task;
        $task->name = $request->name;
        $task->content = $request->content;
        $task->save();
        return redirect('/');
    }
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, task $task)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/tasks/edit/{id}')->withInput()->withErrors($validator);
        }
        $task->name = $request->name;
        $task->name = $request->name;
        $task->content = $request->content;
        $task->save();
        return redirect('/');
    }
    public function derete($id)
    {
        $task = Task::destroy($id);
        return redirect()->route('tasks.index');
    }
}
