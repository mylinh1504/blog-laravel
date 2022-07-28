<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
class CategoryFormRequest extends FormRequest
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
       
        $rules = [
            'name'=>[
                'required',
                'string',
                'max:200',
            ],
            'slug'=>[
                'required',
                'string',
                'max:200',
            ],
            
            'description'=>[
                'required',
                'string',
                'min:20',
            ],
            
            'image'=>[
                'nullable',
                'mimes:jpeg,png,jpg'
            ],
            'navbar_status'=>[
                'nullable'
            ],
            'status'=>[
                'nullable'
            ]

        ];

    return $rules;

    }

    
    // public function messages():array
    // {
    //     return [
    //         // 'name.required'=>'Please enter your name',
    //         // 'content.required' => 'Please enter your content',
    //     ];
    // }
}
