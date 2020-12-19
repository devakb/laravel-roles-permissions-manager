<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('role_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50|unique:roles,title,'.$this->role->id,
            'short_code' => 'nullable|max:50|unique:roles,short_code,'.$this->role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => "integer|exists:permissions,id",
        ];
    }
}
