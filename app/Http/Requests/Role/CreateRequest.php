<?php

namespace App\Http\Requests\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 * @property mixed display_name
 * @property mixed description
 * @property array permissions
 */
class CreateRequest extends FormRequest
{
    /**
     * Permissions which needs to access the current action.
     *
     * @var array
     */
    private $permissions = ['create-role'];

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
            'name'         => 'required|unique:roles',
            'display_name' => 'required',
            //'description' => 'required',
        ];
    }
}
