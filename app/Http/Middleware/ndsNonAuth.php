<?php
/**
 * Created by IntelliJ IDEA.
 * User: keitt
 * Date: 2/19/2017
 * Time: 12:53 AM
 */

namespace App\Http\Middleware;

use Closure;
use App\Http\Library\NdsAuth;

class ndsNonAuth {
    public function handle($request, Closure $next, $guard = null) {
        if (!NdsAuth::isAuth()) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
