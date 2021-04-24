<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorRequest
 * @package App\Http\Requests
 */
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
            // Alles Plichtfelder und mindestens 3 Zeichen lang
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
        ];
    }

    /**
     * Gib mir meine eigene Fehlermeldungen aus
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required'    => 'Bitte einen Vornamen angeben',
            'lastname.required'     => 'Bitte einen Nachnamen angeben',
            'firstname.min'         => 'Der Vorname muß mindesten :min Zeichen enthalten',
            'lastname.min'          => 'Der Nachname muß mindesten :min Zeichen enthalten',
        ];
    }

}
