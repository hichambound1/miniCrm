<?php

namespace App\Http\Middleware;

use App\Models\UserStatu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfEmployeeIsConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $statu= UserStatu::whereName("vérifie")->first();
        if (Auth::check() && Auth::user()->hasRole('employe') &&  Auth::user()->status_id===$statu->id) {
            return $next($request);
        }

        return response()->json([
            'responseMessage' => 'You do not have the required authorization.',
            'responseStatus'  => 403,
        ]);
    }
}
