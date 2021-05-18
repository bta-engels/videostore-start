<?php
namespace App\Http\Requests\Api;

use App\Http\Requests\MovieRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiMovieRequest extends MovieRequest
{
    public $errors;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan('todo-write');
    }

    public function failedValidation(Validator $validator)
    {
        $this->errors = $validator->errors();
    }
}
