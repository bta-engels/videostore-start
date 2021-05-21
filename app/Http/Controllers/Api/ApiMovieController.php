<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Movie;
use App\Events\OnUpdated;
use Illuminate\Http\Response;
use App\Http\Resources\MovieResource;
use App\Http\Requests\Api\ApiMovieRequest as Request;
use Illuminate\Support\Facades\Event;

class ApiMovieController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $this->data = MovieResource::collection(
                Movie::with('author')
                    ->orderByDesc('id')
                    ->get()
                    ->take(20)
            );
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

        return $this->getResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $todo = Movie::find($id);
            if(!$todo) {
                $this->error = __('Sorry, no data available');
            }
            else {
                $this->data = new MovieResource($todo);
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

        return $this->getResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            if($request->errors) {
                $this->error = $request->errors;
            } else {
                $movie = Movie::create($request->validated());
                $this->data = New MovieResource($movie);
                Event::dispatch(new OnUpdated($movie, $request->validated()));
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

        return $this->getResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            if($request->errors) {
                $this->error = $request->errors;
            } else {
                // get movie by ID $id
                $movie = Movie::find($id);
                if($movie) {
                    $movie->update($request->validated());
                    $movie = $movie->refresh();
                    $this->data = new MovieResource($movie);
                    Event::dispatch(new OnUpdated($movie, $request->validated()));
                }
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

        return $this->getResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
           $this->data = Movie::destroy($id);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
        return $this->getResponse();
    }
}
