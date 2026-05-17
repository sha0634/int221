<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index()
    {
        $portfolio = Auth::user()->portfolio;
        
        if (!$portfolio) {
            return view('creator.analytics', [
                'hasPortfolio' => false,
                'totalViews' => 0,
                'weeklyViews' => 0,
                'viewsTrend' => '0% this week',
                'uniqueVisitors' => 0,
                'totalInquiries' => 0,
                'responseRate' => 100,
                'viewsByDay' => [],
                'deviceShare' => ['desktop' => 100, 'mobile' => 0, 'tablet' => 0],
            ]);
        }

        // 1. Total Metrics
        $totalViews = $portfolio->views()->count();
        $uniqueVisitors = $portfolio->views()->distinct('ip_address')->count('ip_address');
        $totalInquiries = $portfolio->inquiries()->count();

        // 2. Weekly Trend calculation
        $viewsThisWeek = $portfolio->views()->where('created_at', '>=', now()->subDays(7))->count();
        $viewsPreviousWeek = $portfolio->views()->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        
        if ($viewsPreviousWeek > 0) {
            $diff = $viewsThisWeek - $viewsPreviousWeek;
            $percent = round(($diff / $viewsPreviousWeek) * 100);
            $viewsTrend = ($percent >= 0 ? '↑ ' : '↓ ') . abs($percent) . '% compared to last week';
        } else {
            $viewsTrend = '↑ ' . $viewsThisWeek . ' new views this week';
        }

        // 3. Dynamic Daily Chart Data (Last 7 Days)
        $viewsByDay = [];
        for ($i = 6; $i >= 0; $i--) {
            $carbonDate = now()->subDays($i);
            $dateStr = $carbonDate->format('Y-m-d');
            $dayName = $carbonDate->format('D');
            $count = $portfolio->views()->whereDate('created_at', $dateStr)->count();
            
            $viewsByDay[] = [
                'day' => $dayName,
                'count' => $count
            ];
        }

        // 4. Device Shares (Mobile vs Desktop vs Tablet)
        $desktopCount = 0;
        $mobileCount = 0;
        $tabletCount = 0;
        foreach ($portfolio->views as $view) {
            $ua = strtolower($view->user_agent);
            if (strpos($ua, 'tablet') !== false || strpos($ua, 'ipad') !== false) {
                $tabletCount++;
            } elseif (strpos($ua, 'mobile') !== false || strpos($ua, 'phone') !== false || strpos($ua, 'android') !== false) {
                $mobileCount++;
            } else {
                $desktopCount++;
            }
        }
        $divisor = max(1, $totalViews);
        $deviceShare = [
            'desktop' => round(($desktopCount / $divisor) * 100),
            'mobile' => round(($mobileCount / $divisor) * 100),
            'tablet' => round(($tabletCount / $divisor) * 100),
        ];

        // 5. Inquiries Response Rate
        $repliedCount = $portfolio->inquiries()->where('status', 'replied')->count();
        $responseRate = $totalInquiries > 0 ? round(($repliedCount / $totalInquiries) * 100) : 100;

        return view('creator.analytics', [
            'hasPortfolio' => true,
            'totalViews' => $totalViews,
            'weeklyViews' => $viewsThisWeek,
            'viewsTrend' => $viewsTrend,
            'uniqueVisitors' => $uniqueVisitors,
            'totalInquiries' => $totalInquiries,
            'responseRate' => $responseRate,
            'viewsByDay' => $viewsByDay,
            'deviceShare' => $deviceShare,
        ]);
    }
}
