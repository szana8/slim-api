<?php

namespace App\Http\Requests\Role;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 * @property mixed display_name
 * @property mixed description
 * @property mixed permissions
 */
class UpdateRequest extends FormRequest
{
    /**
     * Permissions which needs to access the current action.
     *
     * @var array
     */
    protected $permissions = ['update-role'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can($this->permissions);
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
            Rule::unique('roles')->ignore(request()->name),
            'display_name' => 'required',
            //'description' => 'required',
        ];
    }
}
