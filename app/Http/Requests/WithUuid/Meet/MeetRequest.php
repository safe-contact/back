<?php

namespace App\Http\Requests\WithUuid\Meet;

use App\Http\Requests\WithUuid\WithUuidRequest;

class MeetRequest extends WithUuidRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['meetings'] = ['array', 'present'];
        return $rules;
    }
}
