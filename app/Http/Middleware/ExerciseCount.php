<?php

namespace App\Http\Middleware;

use App\Models\Exercise;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExerciseCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $exercises = Exercise::where('user_id', \Auth::user()->id)->get();
        if ($exercises->count() >= 3)
        {
            return $next($request);
        }

        return redirect(route('not-enough'));
    }
}
