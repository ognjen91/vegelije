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
    public function rules(){
      return [
          'name' => 'required|min:2|unique:products,name,NULL,id,manufacturer_id,'.$this->manufacturer_id,
          'tags' => 'min:2', //to je realan minimum, cisto da eliminisem prazan string
          'image'=> 'max:'. config('app.maxfilesize')*1024 . '|mimes:jpg,jpeg,png'
      ];
    }


    public function messages()
    {
        return [
        'name.required' => 'Neophodno je da unesete naziv proizvoda!',
        'name.min' => 'Naziv proizvoda je prekratak i verovatno nije validan!',
        'name.unique'=>'Već postoji proizvod istog imena od odabranog proizvođača',
        'tags.min' => 'Molimo unesite bar jedan tag!',
        'image.uploaded' => 'Slika je prevelika: dozvoljena veličina slike iznosi ' . config('app.maxfilesize') .'MB. Molimo, pokušajte ponovo',
        'image.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'
    ];
    }
}
