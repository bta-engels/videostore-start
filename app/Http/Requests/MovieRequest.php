<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

/**
 * Class MovieRequest
 * @package App\Http\Requests
 */
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'price' => str_replace(',','.', $this->price),
        ]);
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
            'author_id' => 'required',
            'title'     => 'required|min:3',
            'price'     => 'required',
            'image'     => 'nullable|image',
        ];
    }

    /**
     * Gib mir meine eigene Fehlermeldungen aus
     * @return array
     */
    public function messages()
    {
        return [
            'author_id.required'    => 'Bitte einen Autor angeben',
            'title.required'        => 'Bitte einen Titel angeben',
            'title.min'             => 'Der Titel muß mindesten :min Zeichen enthalten',
            'price.required'        => 'Bitte einen Preis angeben',
            'image.image'           => 'Es dürfen nur Bilder hochgeladen werden',
        ];
    }
}
