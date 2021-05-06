<?php
namespace App\Http\Requests\Api;

use App\Http\Requests\TodoRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiTodoRequest extends TodoRequest
{
    public $errors;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        $this->errors = $validator->errors();
    }
}
