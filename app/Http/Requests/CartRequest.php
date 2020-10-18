<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Requests;

use App\Product;
use App\Traits\CryptTrait;
use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = Product::find($this->id);

        return [
            'id' => 'required|numeric|exists:products,id',
            'quantity' => 'required|numeric|gte:1|max:'.$product->quantity,
            'size' => 'required|string',
            'color' => 'required|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->deCrypt($this->id),
        ]);
    }
}
