<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Auth::user()->portfolio;
        
        $templates = [];
        if (!$portfolio) {
            $templates = [
                ['id' => 'modern', 'name' => 'Modern Professional', 'description' => 'Clean, typography-focused design perfect for agencies and designers.'],
                ['id' => 'minimal', 'name' => 'Minimalist', 'description' => 'A stark, whitespace-heavy layout letting your work speak for itself.'],
                ['id' => 'developer', 'name' => 'Developer Terminal', 'description' => 'Code-inspired layout ideal for software engineers.'],
                ['id' => 'creative', 'name' => 'Creative Vibrant', 'description' => 'Bold colors and dynamic layouts for illustrators and artists.'],
                ['id' => 'dark', 'name' => 'Dark Mode', 'description' => 'Sleek, dark aesthetic with neon accents.'],
            ];
        }
        
        return view('creator.portfolio.index', compact('portfolio', 'templates'));
    }

    public function templates()
    {
        $templates = [
            ['id' => 'modern', 'name' => 'Modern Professional', 'description' => 'Clean, typography-focused design perfect for agencies and designers.'],
            ['id' => 'minimal', 'name' => 'Minimalist', 'description' => 'A stark, whitespace-heavy layout letting your work speak for itself.'],
            ['id' => 'developer', 'name' => 'Developer Terminal', 'description' => 'Code-inspired layout ideal for software engineers.'],
            ['id' => 'creative', 'name' => 'Creative Vibrant', 'description' => 'Bold colors and dynamic layouts for illustrators and artists.'],
            ['id' => 'dark', 'name' => 'Dark Mode', 'description' => 'Sleek, dark aesthetic with neon accents.'],
        ];
        return view('creator.portfolio.templates', compact('templates'));
    }

    public function create($template)
    {
        $user = Auth::user();
        $portfolio = $user->portfolio;

        // If the user already has a portfolio, redirect to editor
        if ($portfolio) {
            return redirect()->route('creator.portfolio.editor');
        }

        // Generate unique slug
        $baseSlug = Str::slug($user->name);
        $slug = $baseSlug;
        $count = 1;
        while (Portfolio::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        // Prepopulate with rich predefined dummy data for beautiful first load
        $portfolio = Portfolio::create([
            'user_id' => $user->id,
            'template_name' => $template,
            'theme_color' => 'default',
            'title' => $user->name,
            'bio' => 'Digital Creator & Craftsperson',
            'about_text' => "Hello! I am a passionate creator building high-quality, delightful digital experiences. I specialize in turning complex problems into simple, beautiful designs. Click directly on any text or block on this page to customize it with your own details!",
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80',
            'banner' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1200&h=400&q=80',
            'skills' => ['User Experience', 'Web Design', 'Branding', 'Interface Engineering'],
            'projects' => [
                [
                    'title' => 'Project Alpha',
                    'description' => 'A stunning digital concept exploring spatial interfaces, built with Figma and React.',
                    'link' => 'https://example.com',
                    'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80'
                ],
                [
                    'title' => 'Beta Brand Identity',
                    'description' => 'Comprehensive branding strategy and guidelines for a sustainable materials technology firm.',
                    'link' => 'https://example.com',
                    'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&h=400&q=80'
                ]
            ],
            'social_links' => [
                'github' => 'https://github.com',
                'linkedin' => 'https://linkedin.com',
                'twitter' => 'https://twitter.com'
            ],
            'slug' => $slug,
            'is_live' => false,
        ]);

        return redirect()->route('creator.portfolio.editor');
    }

    public function editor()
    {
        $portfolio = Auth::user()->portfolio;
        if (!$portfolio) {
            return redirect()->route('creator.portfolio.index');
        }

        // Render the editor view with the selected template loaded inside it
        return view('creator.portfolio.editor', compact('portfolio'));
    }

    public function saveAjax(Request $request)
    {
        $portfolio = Auth::user()->portfolio;
        if (!$portfolio) {
            return response()->json(['error' => 'Portfolio not found'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'about_text' => 'nullable|string',
            'theme_color' => 'required|string',
            'skills' => 'nullable|array',
            'projects' => 'nullable|array',
            'social_links' => 'nullable|array',
            'is_live' => 'required|boolean',
            'avatar' => 'nullable|string',
            'banner' => 'nullable|string',
            'slug' => 'required|string|unique:portfolios,slug,' . $portfolio->id,
        ]);

        $portfolio->update($data);

        return response()->json(['success' => true, 'message' => 'Portfolio updated successfully!', 'url' => url('/portfolio/' . $portfolio->slug)]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Move file directly to public directory for easy rendering
            $file->move(public_path('uploads'), $filename);
            
            $url = asset('uploads/' . $filename);

            return response()->json([
                'success' => true,
                'url' => $url
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function toggleLive()
    {
        $portfolio = Auth::user()->portfolio;
        if ($portfolio) {
            $portfolio->update(['is_live' => !$portfolio->is_live]);
        }
        return redirect()->route('creator.portfolio.index');
    }

    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();

        if (!$portfolio->is_live && (!Auth::check() || Auth::id() !== $portfolio->user_id)) {
            abort(404);
        }

        // Track public visitor view (do not track portfolio owner views)
        if (!Auth::check() || Auth::id() !== $portfolio->user_id) {
            $portfolio->views()->create([
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        return view('portfolios.' . $portfolio->template_name, compact('portfolio'));
    }
}
