<?php

namespace App\Http\Requests\WithUuid\Safe;

use App\Http\Requests\WithUuid\WithUuidRequest;

class SafeRequest extends WithUuidRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['lang'] = ['string', 'present'];
        return $rules;
    }
}
