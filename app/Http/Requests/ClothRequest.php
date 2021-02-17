<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClothRequest extends FormRequest
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
            "category_number"=>"required",
            "image"=>"required",
            "comment"=>"max:200"
        ];
    }

    public function attributes()
    {
        return [
            "category_number"=>"選択してください",
            "image"=>"選択してください",
            "comment"=>"200文字以下にしてください"
        ];
    }

}
