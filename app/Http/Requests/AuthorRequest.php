<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'lastname' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'firstname.required'    =>  'Bitte Vornamen eingeben!',
            'firstname.min'         =>  'Der Vorname benötigt wenigstens :min Zeichen!',
            'lastname.required'     =>  'Bitte Nachnamen eingeben!',
            'lastname.min'          =>  'Der Nachname benötigt wenigstens :min Zeichen!'
        ];
    }
}
