<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $data     = null;
    protected $error    = null;

    protected function getResponse()
    {
        $response = [
            'data'  => $this->data,
            'error' => $this->error,
        ];

        return response()->json($response);
    }
}
