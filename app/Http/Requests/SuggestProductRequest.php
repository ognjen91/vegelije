<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuggestProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
     {
         return [
           'name' => 'required',
           'tags' => 'min:2', //to je realan minimum, cisto da eliminisem prazan string
           'images.*'=> 'max:'. config('app.maxfilesize')*1024 . '|mimes:jpg,jpeg,png'

         ];
     }

     public function messages()
     {
         return [
         'name.required' => 'Neophodno je da unesete naziv proizvoda!',
         'tags.min' => 'Molimo unesite bar jedan tag!',
         'images.*.uploaded' => 'Slika je prevelika: dozvoljena veličina slike iznosi ' . config('app.maxfilesize') .'MB. Molimo, pokušajte ponovo',
         'images.*.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'
     ];
     }
}
