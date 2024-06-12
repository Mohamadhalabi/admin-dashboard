<?php

namespace App\Http\Requests\Api\Frontend\User;

use App\Http\Requests\Api\User\BaseRequest;

class AddCompareRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product' => '',
            'products'=>''
        ];
    }
}
