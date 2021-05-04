<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    private $keyAuthorOptions;

    public function __construct()
    {
        $this->keyAuthorOptions = config('cache.key_authors_options');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Author::paginate(10);
        //oder auth()->check()
        if(Auth::check()) {
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
/*
        $author = new Author();
        $author->firstname  = $request->post('firstname');
        $author->lastname   = $request->post('lastname');
        $author->save();
*/
        Author::create($request->validated());
        Cache::delete($this->keyAuthorOptions);

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
/*
        $author->firstname  = $request->post('firstname');
        $author->lastname   = $request->post('lastname');
        $author->save();
*/
        $author->update($request->validated());
        Cache::delete($this->keyAuthorOptions);

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
        Cache::delete($this->keyAuthorOptions);

        return redirect('authors');
    }
}
