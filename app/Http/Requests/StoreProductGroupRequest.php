<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductGroupRequest extends FormRequest
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

    public function __construct(){


    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|unique:products,name',
          'tags' => 'min:2', //to je realan minimum, cisto da eliminisem prazan string
          'image'=> 'max:4000'. config('app.maxfilesize')*1024 . '|mimes:jpg,jpeg,png'

        ];
    }

    public function messages()
    {
        return [
        'name.required' => 'Neophodno je da unesete naziv proizvoda!',
        'name.unique'=>'Grupa proizvoda istovetnog naziva već postoji u bazi!',
        'tags.min' => 'Molimo unesite bar jedan tag!',
        'image.uploaded' => 'Slika je prevelika: dozvoljena veličina slike iznosi ' . config('app.maxfilesize') .'MB. Molimo, pokušajte ponovo',
        'image.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'

    ];
    }
}
