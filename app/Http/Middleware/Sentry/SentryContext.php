<?php

namespace App\Http\Middleware\Sentry;

use App\Facades\UserFacade;
use Closure;
use Sentry\State\Scope;

class SentryContext
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
        if (UserFacade::getUser() && app()->bound('sentry')) {
            \Sentry\configureScope(function (Scope $scope): void {
                $scope->setUser([
                    'id' => UserFacade::getUser()->id,
                ]);
            });
        }
        if(request()->ip()){
            \Sentry\configureScope(function (Scope $scope): void {
                $scope->setTag('ip_client', request()->ip());
            });
        }
        return $next($request);
    }
}
