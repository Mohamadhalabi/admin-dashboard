<?php

namespace App\Http\Requests\Api\Frontend;

use App\Http\Requests\Api\User\BaseRequest;

class ReadNewRequest extends BaseRequest
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
            'id' => 'required|exists:what_news,id'
        ];
    }
}
