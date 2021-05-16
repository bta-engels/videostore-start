<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Todo;
use App\Events\OnUpdated;
use Illuminate\Http\Response;
use App\Http\Requests\TodoRequest as Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Todo::translated()
            ->orderBy("created_at", 'desc')
            ->paginate(50)
        ;
        if(Auth::check()) { //auth()->check()
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $todo = Todo::create($request->validated());
        event(new OnUpdated($todo, $request->validated()));
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
     * @param  \Illuminate\Http\Request  $request
     * @param Todo $todo
     * @return Response
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->validated());
        event(new OnUpdated($todo->refresh(), $request->validated()));

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
