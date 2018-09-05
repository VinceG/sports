<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class PlayerRequest extends ApiRequest
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
                'first_name' => 'required|alpha_dash|max:150',
                'last_name' => 'required|alpha_dash|max:150',
                'team_id' => 'required|exists:team,id'
            ];
        }

        return [];
    }
}
