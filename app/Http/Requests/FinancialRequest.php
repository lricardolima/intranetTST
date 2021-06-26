<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialRequest extends FormRequest
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

            'title'=>'bail|required',
            'description' => 'nullable',
            'photo' => 'image|nullable|max:1999',
            'type' => 'bail|required',
            'link' => 'bail|required',
            'responsible' => 'bail|required',

        ];
    }
}
