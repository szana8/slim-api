<?php

namespace App\Http\Requests\Issue\TypeSchema;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed issueTypes
 * @property mixed name
 */
class UpdateRequest extends FormRequest
{
    /**
     * Permissions which needs to access the current action.
     *
     * @var array
     */
    private $permissions = ['update-issue-type-schema'];

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
            'name'         => 'required',
            'description'  => 'required',
            'default_type' => 'required',
        ];
    }
}
