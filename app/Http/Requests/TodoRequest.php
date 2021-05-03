<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text'  => 'required|min:5',
            'done'  => '',
        ];
    }

    public function messages()
    {
        return [
            'text.required'  => 'Bitte einen Text eingeben',
            'text.min'  => 'Der Text muß mindestens :min Zeichen enthalten',
        ];
    }
}
