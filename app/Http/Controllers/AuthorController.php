<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Author::paginate(10);
        if(Auth::check()) { //auth()->check()
            return view('admin.authors.index', compact('data'));
        } else {
            return view('public.authors.index', compact('data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return Response
     */
    public function show(Author $author)
    {
        return view('public.authors.show', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(AuthorRequest $request)
    {

        Author::create($request->validated());
        /*
            $data = $request->except('_token');
            Author::create($data);
        */
        /*
            $data = $request->except('_token');
            $author = new Author();
            $author->insert($data);
        */
        /*
            $author = new Author();
            $author->firstname = $request->post('firstname');
            $author->lastname = $request->post('lastname');
            $author->save();
        */
        return redirect('authors');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return Response
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Author $author
     * @return Response
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        /*
        $data = $request->except('_token');
        $author->update($data);
        */
        /*
        $author->firstname = $request->post('firstname');
        $author->lastname = $request->post('lastname');
        $author->save();
        */
        return redirect('authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('authors');
    }
}
