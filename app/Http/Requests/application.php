<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class application extends FormRequest
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
        'cabel_length'  => 'required',
        'type_application'       => 'required',
        'name_of_applicant' => 'required',
        'company_name'      => 'required',
        'telephone_no'      => 'required|min:9|max:11',
        'address'           => 'required',
        'parlimen'          => 'required',
        'road_involved'     => 'required',
        'division'          => 'required' ,
        'work_type'         => 'required'
        ];
    }
}
