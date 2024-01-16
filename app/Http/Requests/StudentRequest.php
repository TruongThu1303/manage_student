<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:255'
            ,'email' => 'required|string|max:255'
            ,'masv' => 'required|string|max:255'
            ,'phone' => 'required|string|max:20'
        ];
    }
    public function messages()
    {
    return[
        'fullname.required' => trans('validation.students.fullname_required')
        ,'fullname.string' => trans('validation.students.fullname_string')
        ,'fullname.max' => trans('validation.students.fullname_max')
        ,'email.required' => trans('validation.students.email_required')
        ,'email.string' => trans('validation.students.email_string')
        ,'email.max' => trans('validation.students.email_max')
        ,'masv.required' => trans('validation.students.masv_required')
        ,'masv.string' => trans('validation.students.masv_string')
        ,'masv.max' => trans('validation.students.masv_max')
        ,'phone.required' => trans('validation.students.phone_required')
        ,'phone.max' => trans('validation.students.phone_max')
    ];
    }
    }
