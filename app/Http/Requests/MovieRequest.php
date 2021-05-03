<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Support\Facades\Storage;

class MovieRequest extends FormRequest
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
            'author_id'  => 'required',
            'title'  => 'required',
            'price'  => 'required',
            'image'  => '',
        ];
    }

    public function messages()
    {
        return [
            'author_id.required'    => 'Bitte einen Autor angeben',
            'title.required'        => 'Bitte einen Titel angeben',
            'price.required'        => 'Bitte einen Preis angeben',
        ];
    }
}
