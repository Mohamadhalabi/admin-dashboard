<?php

namespace App\Http\Requests\Api\Frontend;

use App\Http\Requests\Api\User\BaseRequest;

class ContactUsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'subject' => 'required|min:5',
            'message' => 'required'
        ];
    }
}
