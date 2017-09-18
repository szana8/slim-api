<?php

namespace App\Http\Requests\Issue\Resolution;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed resolution
 */
class AccessRequest extends FormRequest
{
    /**
     * Permissions which needs to access the current action.
     *
     * @var array
     */
    private $permissions = ['read-issue-type-resolution'];

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
            //
        ];
    }
}
