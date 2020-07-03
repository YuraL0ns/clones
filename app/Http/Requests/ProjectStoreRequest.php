<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'name' => 'required',
            'quest' => ['nullable'],
            'start' => ['nullable'],
            'end' => ['nullable'],
            'ps' => ['nullable'],
            'pe' => ['nullable'],
            'ss' => ['nullable'],
            'se' => ['nullable'],
            'prs' => ['nullable'],
            'pre' => ['nullable'],
//            'files' => ['nullable', 'array'],
//            'file_types' => ['nullable', 'array'],
//            'file_types.*' => ['nullable', 'in:report,document,drawing'],
//            'files.*' => ['nullable', 'mimes:jpg,jpeg,png,pdf,docx', 'max:4096'],
//            'safe_detail' => ['nullable', 'integer'],
//            'safe_material' => ['nullable', 'integer'],
//            'safe_purchased' => ['nullable', 'integer'],
//            'safe_detail_count' => ['nullable', 'integer'],
//            'safe_material_count' => ['nullable', 'integer'],
//            'safe_purchased_count' => ['nullable', 'integer'],
            'new_safe_name' => ['nullable'],
            'new_safe_type' => ['nullable', 'in:detail,purchased,material'],
            'new_safe_count' => ['nullable', 'integer'],
            'new_safe_use' => ['nullable', 'integer']
        ];
    }
}
