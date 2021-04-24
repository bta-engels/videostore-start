<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorRequest
 * @package App\Http\Requests
 */
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
     * wird vor der validierung ausgeführt
     * dient zur vorbereitenden preparierung der daten
     * @return array
     */
    public function validationData()
    {
        // setze das checkbox-feld 'done' initial auf false,
        // damit es per request immer present ist
        // d.h: auch bei nicht angeklickter checkbox (wird dann normalerweise per POST NICHT
        // als array-element gesendet)
        return array_merge(['done' => false], $this->all());
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
            'text'  => 'required|min:3|max:50',
            'done'  => '',
        ];
    }

    /**
     * Gib mir meine eigene Fehlermeldungen aus
     * @return array
     */
    public function messages()
    {
        return [
            'text.required'    => 'Bitte einen Text eingeben',
            'text.min'         => 'Der Text muß mindesten :min Zeichen enthalten',
            'text.max'         => 'Der Text darf maximal :max Zeichen enthalten',
        ];
    }

}
