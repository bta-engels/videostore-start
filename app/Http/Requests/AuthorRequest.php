<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Str;

class AuthorRequest extends FormRequest
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
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required'    => 'Bitte einen Vornamen angeben',
            'firstname.min'         => 'Der Vorname muß mindestens :min Zeichen enthalten',
            'lastname.required'     => 'Bitte einen Nachnamen angeben',
            'lastname.min'          => 'Der Nachname muß mindestens :min Zeichen enthalten',
        ];
    }
}
