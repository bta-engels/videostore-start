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

    protected function prepareForValidation()
    {
        $this->merge(['price' => str_replace(',','.', $this->price)]);
    }

    public function validated()
    {
        $validated = parent::validated();

        if (request()->hasFile('image')) {
            $file = $this->file('image');
            // @todo: validierung abfragen
            if($file->isValid()) {
                $hashName = $file->hashName();
                // @todo: upload und db eintrag
                $file->storeAs('images', $hashName, 'public');
                $validated['image'] = $hashName;
            }
        }

        return $validated;
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
            'image'  => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
            'author_id.required'    => 'Bitte einen Autor angeben',
            'title.required'        => 'Bitte einen Titel angeben',
            'price.required'        => 'Bitte einen Preis angeben',
            'image.image'           => 'Datei muß eine Bild-Datei sein',
        ];
    }
}
