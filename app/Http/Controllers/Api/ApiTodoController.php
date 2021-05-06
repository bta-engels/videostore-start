<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            $this->data = Todo::all();
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
            $this->data = $todo;
            if(!$todo) {
                $this->error = __('Sorry, no data available');
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
        //
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
