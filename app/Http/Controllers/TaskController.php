<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function index(Todo $todo)
    {
        return view('tasks.index')
            ->withTodo($todo)
            ->withTasks($todo->tasks()->latest()->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, Todo $todo)
    {
        $todo->tasks()->create($request->all());

        flash()->addSuccess('Task has been created successfully.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo, Task $task)
    {
        return view('tasks.show')
            ->withTask($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo, Task $task)
    {
        return view('tasks.edit')
            ->withTodo($todo)
            ->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Todo $todo, Task $task)
    {
        $task->update(['description' => $request->description]);

        flash()->addSuccess('Task has been updated successfully.');

        return redirect()->route('todos.tasks.index', [$todo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo, Task $task)
    {
        $task->delete();

        flash()->addSuccess('Task has been delete successfully.');

        return redirect()->route('todos.tasks.index', [$todo]);
    }
}
