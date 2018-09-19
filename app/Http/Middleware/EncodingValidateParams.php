<?php

namespace App\Http\Middleware;

use Closure;

class EncodingValidateParams
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
        dd($request->all());
        foreach ($request->all() as  $value) {
            if (! $this->isValidEncoding($value)) {
                dd($value);
                abort(400,'Bad Request');
            }
        }
        return $next($request);
    }

    public function isValidEncoding($val){
        if (mb_check_encoding($val, mb_internal_encoding())) {
            return true;
        }

        return false;
    }
}
