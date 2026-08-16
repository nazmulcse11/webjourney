<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\QuizType;
use App\Models\Post;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $metrics = $this->getMetricsData();
        return view('backend.dashboard.dashboard', compact('metrics'));
    }

    public function realtime_data()
    {
        $metrics = $this->getMetricsData();
        return response()->json($metrics);
    }

    private function getMetricsData()
    {
        $sessions = Cache::get('active_user_sessions', []);
        $now = now()->timestamp;
        $activeCount = 0;
        $webUsers = 0;
        $mobileUsers = 0;
        $pageCounts = [];

        foreach ($sessions as $sessionId => $timestamp) {
            if (($now - $timestamp) >= 180) {
                continue;
            }

            $userData = Cache::get('active_user_' . $sessionId);
            if (!$userData) {
                continue;
            }

            $activeCount++;
            if (($userData['device'] ?? 'web') === 'mobile') {
                $mobileUsers++;
            } else {
                $webUsers++;
            }

            $path = $userData['path'] ?? '/';
            if (!isset($pageCounts[$path])) {
                $pageCounts[$path] = 0;
            }
            $pageCounts[$path]++;
        }

        $pages = [];
        foreach ($pageCounts as $path => $count) {
            $pages[] = [
                'title' => $this->resolvePageTitle($path),
                'path' => $path,
                'active_users' => $count,
            ];
        }

        usort($pages, function ($a, $b) {
            return $b['active_users'] <=> $a['active_users'];
        });

        return [
            'active_users' => $activeCount,
            'web_users' => $webUsers,
            'mobile_users' => $mobileUsers,
            'pages' => $pages,
        ];
    }

    private function resolvePageTitle($path)
    {
        if ($path === '/' || $path === '') {
            return 'Home Page';
        }

        $trimmed = trim($path, '/');
        $parts = explode('/', $trimmed);

        if ($parts[0] === 'about-us') return 'About Us';
        if ($parts[0] === 'contact-us') return 'Contact Us';
        if ($parts[0] === 'privacy-policy') return 'Privacy Policy';
        if ($parts[0] === 'terms-of-use') return 'Terms of Use';

        if ($parts[0] === 'tutorial' && isset($parts[1])) {
            if ($parts[1] === 'sub' && isset($parts[2])) {
                $subcat = Subcategory::where('slug', $parts[2])->first();
                return $subcat ? 'Subcategory: ' . $subcat->name : 'Subcategory: ' . ucfirst($parts[2]);
            }
            $cat = Category::where('slug', $parts[1])->first();
            return $cat ? 'Category: ' . $cat->name : 'Category: ' . ucfirst($parts[1]);
        }

        if ($parts[0] === 'quiz' && isset($parts[1])) {
            $type = QuizType::where('slug', $parts[1])->first();
            return $type ? 'Quiz: ' . $type->type : 'Quiz: ' . ucfirst($parts[1]);
        }

        if (count($parts) === 1) {
            $post = Post::where('slug', $parts[0])->first();
            if ($post) {
                return $post->title;
            }
        }

        return ucwords(str_replace(['-', '_'], ' ', end($parts)));
    }
}
