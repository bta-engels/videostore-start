<?php

namespace App\Http\Controllers\Api;

use App\Events\OnUpdated;
use Exception;
use App\Models\Todo;
use Illuminate\Http\Response;
use App\Http\Resources\TodoResource;
use App\Http\Requests\Api\ApiTodoRequest as Request;
use Illuminate\Support\Facades\Event;

class ApiTodoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $this->data = TodoResource::collection(Todo::all());
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
            $todo = Todo::find($id);
            if(!$todo) {
                $this->error = __('Sorry, no data available');
            }
            else {
                $this->data = new TodoResource($todo);
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
        /* wenn spez. token rechte gesetzt sind
        if(!$request->user()->tokenCan('todo-store')) {
            $this->error = 'Nicht erlaubt';
            return $this->getResponse();
        }
*/
        try {
            if($request->errors) {
                $this->error = $request->errors;
            } else {
                $todo = Todo::create($request->validated());
                $this->data = New TodoResource($todo);
                Event::dispatch(new OnUpdated($todo, $request->validated()));
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
                // get todo by ID $id
                $todo = Todo::find($id);
                if($todo) {
                    $todo->update($request->validated());
                    $todo = $todo->refresh();
                    $this->data = new TodoResource($todo);
                    Event::dispatch(new OnUpdated($todo, $request->validated()));
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
           $this->data = Todo::destroy($id);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

        return $this->getResponse();
    }
}
