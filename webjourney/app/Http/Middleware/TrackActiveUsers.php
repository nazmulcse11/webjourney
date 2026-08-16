<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackActiveUsers
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
        $response = $next($request);

        // Only track GET requests
        if (!$request->isMethod('GET')) {
            return $response;
        }

        // Do not track AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return $response;
        }

        $path = '/' . ltrim($request->path(), '/');

        // Ignore admin pages, API routes, asset paths, and debugging endpoints
        if (
            str_starts_with($path, '/admin') ||
            str_starts_with($path, '/api') ||
            str_starts_with($path, '/storage') ||
            str_starts_with($path, '/images') ||
            str_starts_with($path, '/assets') ||
            str_starts_with($path, '/backend') ||
            str_starts_with($path, '/frontend')
        ) {
            return $response;
        }

        // Ignore static asset file extensions
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|svg|ico|woff|woff2|ttf|eot|mp4|webm|webp|pdf|zip|rar|map|json)$/i', $path)) {
            return $response;
        }

        $userAgent = $request->header('User-Agent');

        // Ignore empty user-agents or known bots and crawlers
        if (empty($userAgent) || preg_match('/(bot|crawl|spider|slurp|facebook|python|curl|wget|guzzle|httpclient|checker|monitoring|scan|headless|semrush|ahrefs|bingbot|googlebot|yandex|duckduckbot|baiduspider|bytespider|gptbot|claudebot|chatgpt|screaming|lighthouse)/i', $userAgent)) {
            return $response;
        }

        // Determine session identifier
        $sessionId = $request->session()->getId();
        if (empty($sessionId)) {
            $sessionId = md5($request->ip() . '_' . $userAgent);
        }

        // Device detection (Mobile vs Web)
        $isMobile = (bool) preg_match('/(mobile|android|iphone|ipad|ipod|blackberry|webos|opera mini|iemobile|kindle)/i', $userAgent);

        $now = now()->timestamp;

        // Store user activity in cache for 3 minutes (180 seconds)
        Cache::put('active_user_' . $sessionId, [
            'session_id' => $sessionId,
            'ip' => $request->ip(),
            'path' => $path,
            'device' => $isMobile ? 'mobile' : 'web',
            'user_agent' => $userAgent,
            'last_activity' => $now,
        ], 180);

        // Update active sessions registry index
        $sessions = Cache::get('active_user_sessions', []);
        // Clean sessions older than 180 seconds
        $sessions = array_filter($sessions, function ($ts) use ($now) {
            return ($now - $ts) < 180;
        });
        $sessions[$sessionId] = $now;
        Cache::put('active_user_sessions', $sessions, 3600);

        return $response;
    }
}
