<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->roles()->where('name', 'admin')->exists()) {
                return $next($request);
            }

            return response()->json([
                "message" => 'غير مصرح لك'
            ], 403); // استخدام كود الحالة 403 للرفض
        }

        return response()->json([
            "message" => 'قم بتسجل الدخول'
        ], 401); // استخدام كود الحالة 401 لطلب التحقق من الهوية
    }
}
