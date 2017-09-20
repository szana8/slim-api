<?php

namespace App\Http\Requests\Issue\CustomField;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 * @property mixed description
 * @property mixed type
 * @property mixed api
 * @property mixed protected
 * @property mixed permissions
 */
class UpdateRequest extends FormRequest
{
    /**
     * Permissions which needs to access the current action.
     *
     * @var array
     */
    private $permission = ['update-custom-field'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can([$this->permission]);
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
            Rule::unique('custom_fields')->ignore(request()->name),
            'type' => 'required',
        ];
    }
}
