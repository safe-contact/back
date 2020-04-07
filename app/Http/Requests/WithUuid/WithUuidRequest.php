<?php

namespace App\Http\Requests\WithUuid;

use App\Facades\UserFacade;
use App\Http\Requests\RequestCovid;

/**
 * le validator des request avec des filtres
 */
class WithUuidRequest extends RequestCovid
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userId' => ['present', 'string'],
            'deviceId' => ['present', 'string']
        ];
    }
}
