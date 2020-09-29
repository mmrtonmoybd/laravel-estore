<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\CryptTrait;

class CartRequest extends FormRequest
{
	use CryptTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    protected function prepareForValidation() {
       $this->merge([
       'id' => $this->deCrypt($this->id)
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
            'id' => 'required|numeric|exists:products,id',
			'quantity' => 'required|numeric|max:5|gte:1',
			'size' => 'required|string',
			'color' => 'required|string',
        ];
    }
}