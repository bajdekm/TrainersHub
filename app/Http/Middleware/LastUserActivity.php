<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Utils\CommonConstans;
use App\Http\Controllers\Utils\RedisManager;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class LastUserActivity
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
        try{
            if( Auth::check() ){
                $redisManager = RedisManager::getInstance();
                $redisManager::putValue( CommonConstans::$LOGGED_USER_CACHE_PREFIX . Auth::user()->id , 'online' ,3 );
            }
        }
        catch (\Exception $e){
            error_log('Exception raised because user has not context login');
        }

        return $next($request);
    }
}
