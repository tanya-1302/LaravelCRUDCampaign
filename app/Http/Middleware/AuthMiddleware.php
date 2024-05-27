<?php

namespace App\Http\Middleware;

use App\Models\Manufacturer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Product;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Decode jwt to get manufaturer id
        if ($request->header('authorization')) {
            try {
                $res = JWT::decode(request()->header('authorization'), new Key('secret', 'HS256'));

            } catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }

        // Validate manufaturer id
        $mf = Manufacturer::find($res->mf_id);
        if($mf){           }
            $request->merge(['manufacturer' => $mf]);
        }
        else{
            return response()->json('mf_id does not exist');
        }
        return $next($request);
    }
}
