<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
      //da u slucaju greske vrati tagove


    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
          'name' => 'required|min:2',
          'tags' => 'min:2' //to je realan minimum, cisto da eliminisem prazan string
      ];
    }


    public function messages()
    {
        return [
        'name.required' => 'Neophodno je da unesete naziv proizvoda!',
        'name.min' => 'Naziv proizvoda je prekratak i verovatno nije validan!',
        'tags.min' => 'Molimo unesite bar jedan tag!'
    ];
    }
}
