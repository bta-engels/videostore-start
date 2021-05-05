<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

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
        $this->merge(['price' => str_replace(',', '.', $this->price)]);
    }

    public function validated()
    {
        $validated = parent::validated();
        if(request()->hasFile('image')) {
            $file = $this->file('image');
            if($file->isValid()) {
                $hashName = $file->hashName();
                // Upload und db Eintrag
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
            'author_id'     =>  'required',
            'title'         =>  'required',
            'price'         =>  'required',
            'image'         =>  'nullable|image'
        ];
    }

    public function messages()
    {
        return [
          'author_id.required'  =>  'Bitte einen Autoren wählen!',
          'title.required'      =>  'Bitte einen Titel setzen!',
          'price.required'      =>  'Bitte einen Preis setzen!',
          'image.image'         =>  'Datei muss eine Bild-Datei sein!'
        ];
    }
}
