<?php

namespace Modules\Contact\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @class BloodGroupRequest
 * @package Modules\Contact\Http\Requests\Setting
 */
class BloodGroupRequest extends FormRequest
{
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

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
