<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestCovid;

/**
 * le validator des request avec des filtres
 */
class UserRequest extends RequestCovid
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'deviceId' => ['present', 'string']
        ];
    }
}
