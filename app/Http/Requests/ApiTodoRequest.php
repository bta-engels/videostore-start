<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

/**
 * Class AuthorRequest
 * @package App\Http\Requests
 */
class ApiTodoRequest extends TodoRequest
{
    /**
     * @var Validator
     */
    public $validator = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        // keine weiterleitung mehr zum formular zurück
        $this->validator = $validator;
    }
}
