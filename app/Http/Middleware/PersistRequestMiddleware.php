<?php

namespace App\Http\Middleware;

use App\Models\PersistRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PersistRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $log = [
            'user_id' => auth()->user()->id,
            'path' => $request->path(),
            'request_body' => $request->all(),
            'response_body' => $response->getContent(),
            'status_code' => $response->getStatusCode(),
            'origin_ip' => $request->ip(),
        ];


        try {
            PersistRequest::create($log);
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
            Log::warning($log);
        }

        return $next($request);
    }
}
