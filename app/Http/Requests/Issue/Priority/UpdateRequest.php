<?php

namespace App\Http\Requests\Issue\Priority;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 */
class UpdateRequest extends FormRequest
{
    /**
     * Permissions which needs to access the current action.
     *
     * @var array
     */
    private $permissions = ['update-priority'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can([$this->permissions]);
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
            Rule::unique('issue_priorities')->ignore(request()->name),
            'icon' => 'required',
        ];
    }
}
