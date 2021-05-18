<?php

namespace App\Http\Controllers\Api;

use App\Events\OnUpdated;
use App\Http\Resources\AuthorResource;
use Exception;
use App\Models\Author;
use Illuminate\Http\Response;
use App\Http\Resources\TodoResource;
use App\Http\Requests\Api\ApiTodoRequest as Request;
use Illuminate\Support\Facades\Event;

class ApiAuthorController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $this->data = AuthorResource::collection(Author::all());
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

        return $this->getResponse();
    }
}
