<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Todo::paginate(10);
        if(Auth::check()) {
            return view('admin.todos.index', compact('data'));
        } else {
            return view('public.todos.index', compact('data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return Response
     */
    public function show(Todo $todo)
    {
        return view('public.todos.show', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TodoRequest  $request
     * @return Response
     */
    public function store(TodoRequest $request)
    {
        Todo::create($request->validated());
        return redirect('todos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Todo $todo
     * @return Response
     */
    public function edit(Todo $todo)
    {
        return view('admin.todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TodoRequest  $request
     * @param Todo $todo
     * @return Response
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());
        return redirect('todos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect('todos');
    }
}
