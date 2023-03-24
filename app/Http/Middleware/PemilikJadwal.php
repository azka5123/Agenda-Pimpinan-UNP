<?php

namespace App\Http\Middleware;

use App\Models\Jadwal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikJadwal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = Auth::user();
        $jadwal = Jadwal::findOrFail($request->id);
        if ($currentUser->id != $jadwal->user_id) {
            return response()->json(['message' => 'data not found']);
        }
        return $next($request);
    }
}
