<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheAssets
{
    /**
     * Handle an incoming request.
     * Set cache headers for static assets to improve performance.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only cache for non-authenticated requests or static assets
        $path = $request->path();

        // Set ETag for caching
        if ($request->isMethod('GET') && !$request->ajax()) {
            $etag = md5($response->getContent());
            $response->setEtag($etag);

            // Check if not modified
            if ($request->header('If-None-Match') === '"' . $etag . '"') {
                $response->setNotModified();
            }
        }

        return $response;
    }
}
