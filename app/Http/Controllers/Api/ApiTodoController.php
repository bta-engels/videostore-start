<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Exception;
use App\Http\Requests\Api\ApiTodoRequest as Request;
use Illuminate\Http\Response;
use App\Http\Resources\TodoResource;

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
        try {
            if($request->errors) {
                $this->error = $request->errors;
            } else {
                $this->data = New TodoResource(Todo::create($request->validated()));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
