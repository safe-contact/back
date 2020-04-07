<?php

namespace App\Http\Controllers\Meet;

use App\Exceptions\CovidException;
use App\Facades\MeetFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\WithUuid\Meet\MeetRequest;

class MeetController extends Controller
{
    public function create(MeetRequest $meetRequest)
    {
        $meetings = $meetRequest->validated()['meetings'];
        MeetFacade::createForUser($meetings);
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
