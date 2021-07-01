<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_en' => 'required|max:100' ,
            'name_ar' => 'required|max:100' ,
            'price' => 'required|numeric' ,
            'details_en' => 'required' ,
            'details_ar' => 'required' ,
        ];
    }
    public function messages()
    {
        return [
             // the key messages is refer to lang files "translation between english and arabic"
                  'name_en.required' => __('messages.offer name_en required'),
                  'name_ar.required' => __('messages.offer name_ar required'),
//                  'name_en.unique' => __('messages.offer name_en taken'),
//                  'name_ar.unique' => __('messages.offer name_ar taken'),
                  'price.required' => __('messages.offer price required'),
                  'price.numeric' => __('messages.offer must be a number'),
                  'details_en.required' => __('messages.offer details_en required'),
                  'details_ar.required' => __('messages.offer details_ar required'),

        ];
    }
}
