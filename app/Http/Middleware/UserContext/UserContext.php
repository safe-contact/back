<?php

namespace App\Http\Middleware\UserContext;

use App\Exceptions\CovidException;
use Closure;
use App\Facades\UserFacade;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = UserFacade::findOneByCriteria([
            'id' => $request->userId,
            'deviceId' => $request->deviceId
        ]);
        if($user){
            UserFacade::setUser($user);
            return $next($request);
        }
        throw new CovidException('User does not exist');
    }
}
