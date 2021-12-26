<?php

namespace Modules\Contact\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @class GroupRequest
 * @package Modules\Contact\Http\Requests\Common
 */
class GroupRequest extends FormRequest
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
