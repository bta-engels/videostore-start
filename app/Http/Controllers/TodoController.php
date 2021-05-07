<?php

namespace App\Http\Controllers;

use App;
use App\Models\Language;
use App\Models\Todo;
use App\Models\TodoLang;
use Auth;
use App\Http\Requests\TodoRequest as Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Todo::orderBy("created_at", 'desc')->paginate(10);
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
        $todo->text = $todo->current_lang_text();
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
        $lang = App::getLocale();
        $language = Language::whereCode($lang)->get()->first();
        $todo_lang = $todo->todo_langs->where('language_id' , $language->id)->first();
        if($todo_lang) {
            $todo_lang->update_text($request->validated()['text']);
        } else {
            $todo_id = $todo->id;
            TodoLang::create([
                'todo_id'       =>  $todo_id,
                'language_id'   =>  $language->id,
                'text'          =>  $request->validated()['text']
            ]);
        }

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
