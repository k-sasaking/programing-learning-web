<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateFormRequest extends FormRequest
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
            'admin_name'       => 'required',
            'email'       => 'required|email',
            'login_id'       => 'required|alpha_num_half|max:20',
            'password'       => 'nullable|alpha_num_symbol_half|min:6|max:20|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required'         => ':attributeは必ず入力してください',
            'email.required'         => ':attributeは必ず入力してください',
            'login_id.required'         => ':attributeは必ず入力してください',
            'login_id.max'         => ':attributeは:max文字以内で入力してください',
            'password.required'         => ':attributeは必ず入力してください',
            'password.min'         => ':attributeは:min文字以上にしてください',
            'password.max'         => ':attributeは:max文字以内にしてください',
        ];
    }
}
