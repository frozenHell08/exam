<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules() //: array
    {
        return [
            "title" => "required|max:255",
            "author" => "required|max:255",
            "series" => "required|max:255",
            "pubmonth" => ""
        ];
    }
}
