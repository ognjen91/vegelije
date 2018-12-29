<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
          'tags' => 'min:2' //to je realan minimum, cisto da eliminisem prazan string
      ];
    }

    public function messages()
    {
        return [
        'name.required' => 'Neophodno je da unesete naziv proizvoda!',
        'tags.min' => 'Molimo unesite bar jedan tag!'
    ];
    }
}
