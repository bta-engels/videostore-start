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

    protected function prepareForValidation()
    {
        $this->merge(['done' => $this->done ? 1 : 0]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'done'     =>  '',
            'text'     =>  'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'text.required'  =>  'Bitte eine Beschreibung angeben!',
            'text.min'  =>  'Bitte wenigstens :min Zeichen als Beschreibung angeben!'
        ];
    }
}
