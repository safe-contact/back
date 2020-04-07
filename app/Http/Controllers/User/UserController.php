<?php

namespace App\Http\Controllers\User;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\WithUuid\Safe\SafeRequest;
use App\Http\Requests\WithUuid\WithUuidRequest;

class UserController extends Controller
{
    public function create(UserRequest $userRequest)
    {
        $user = UserFacade::create($userRequest->validated());
        if($user){
            return response()->json([
                'id' => $user->id
            ], 200);
        }
        return response()->json([
            'status' => 'error'
        ], 400);
    }

    public function diagnostic(WithUuidRequest $request)
    {
        UserFacade::setCurrentSick();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function safe(SafeRequest $request)
    {
        $health = UserFacade::isSafe();
        return response()->json(
            $health->summary($request->validated()['lang'])
        );
    }

    public function recovered(WithUuidRequest $request)
    {
        UserFacade::setCurrentRecovered();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function symptom(WithUuidRequest $request)
    {
        UserFacade::setCurrentSymptom();

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
