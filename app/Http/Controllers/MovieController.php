<?php

namespace App\Http\Controllers;

use App\Events\OnUpdated;
use App\Http\Requests\MovieRequest;
use App\Models\Author;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class MovieController extends Controller
{
    private $authors;

    public function __construct()
    {
        $this->authors = Author::options();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $selectedAuthor = $request->post('selectedAuthor');
        $query = Movie::translated()->with('author');
        if($selectedAuthor) {
            $query->whereAuthorId($selectedAuthor);
        }
        $data = $query->paginate(50);

        if(Auth::check()) {
            return view('admin.movies.index', compact('data', 'selectedAuthor'));
        } else {
            return view('public.movies.index', compact('data', 'selectedAuthor'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return Response
     */
    public function show(Movie $movie)
    {
        return view('public.movies.show', compact('movie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(MovieRequest $request)
    {
        $movie = Movie::create($request->validated());
        event(new OnUpdated($movie));

        return redirect('movies');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return Response
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());
        event(new OnUpdated($movie->refresh()));

        return redirect('movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect('movies');
    }
}
