<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class TeamRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (in_array($this->method(), ['POST', 'PUT'])) {
            return [
                'name' => 'required|string|max:150',
            ];
        }

        return [];
    }
}
