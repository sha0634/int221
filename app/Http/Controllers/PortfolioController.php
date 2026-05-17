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
                ['id' => 'developer', 'name' => 'Boutique Interior Design', 'description' => 'A luxury, concrete-textured boutique layout perfect for designers and architects.'],
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
            ['id' => 'developer', 'name' => 'Boutique Interior Design', 'description' => 'A luxury, concrete-textured boutique layout perfect for designers and architects.'],
            ['id' => 'creative', 'name' => 'Creative Vibrant', 'description' => 'Bold colors and dynamic layouts for illustrators and artists.'],
            ['id' => 'dark', 'name' => 'Dark Mode', 'description' => 'Sleek, dark aesthetic with neon accents.'],
        ];
        return view('creator.portfolio.templates', compact('templates'));
    }

    public function create($template)
    {
        $user = Auth::user();
        $portfolio = $user->portfolio;

        // Generate unique slug
        if ($portfolio) {
            $slug = $portfolio->slug;
        } else {
            $baseSlug = Str::slug($user->name);
            $slug = $baseSlug;
            $count = 1;
            while (Portfolio::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
        }

        // Prepopulate with rich predefined dummy data for beautiful first load
        $title = $user->name;
        if ($template === 'modern') {
            $title = 'Emma Holistic';
        } elseif ($template === 'minimal') {
            $title = 'Adam Smith';
        } elseif ($template === 'developer') {
            $title = 'Mary Dench';
        }

        $bio = 'Digital Creator & Craftsperson';
        if ($template === 'modern') {
            $bio = 'Through nourishing recipes, mindful movement, and sustainable practices, I share my journey of balanced and healthy living.';
        } elseif ($template === 'minimal') {
            $bio = 'architect & designer';
        } elseif ($template === 'developer') {
            $bio = 'Professional interior designer in New York.';
        }
        
        $aboutText = "Hello! I am a passionate creator building high-quality, delightful digital experiences. I specialize in turning complex problems into simple, beautiful designs. Click directly on any text or block on this page to customize it with your own details!";
        if ($template === 'modern') {
            $aboutText = "Hello! I am Emma, a holistic health, beauty, and lifestyle creator. I believe in nourishing the body and mind through conscious, balanced living. Click directly on any text on this page to edit and replace with your own content!";
        } elseif ($template === 'minimal') {
            $aboutText = "I'm a licensed architect and interior designer located in New York and working all over the USA. I believe in standard-setting structures built with high sustainability.";
        } elseif ($template === 'developer') {
            $aboutText = "Hi, I'm Mary and I'm an interior designer in New York. I carefully create spaces it's a real pleasure to live in. I have been working in this area for 5 years now, and create projects mainly in the minimalism, modern, boho styles. I am always open to interesting proposals and take on both an integral design project of a private house and renovations in one room with the same zeal.";
        }

        $avatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80';
        if ($template === 'modern') {
            $avatar = '/p11.png';
        } elseif ($template === 'minimal') {
            $avatar = '/p12.png';
        } elseif ($template === 'developer') {
            $avatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&h=600&q=80';
        }

        $banner = 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1200&h=400&q=80';
        if ($template === 'modern') {
            $banner = 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=1200&h=600&q=80';
        } elseif ($template === 'minimal') {
            $banner = '/b11.png';
        } elseif ($template === 'developer') {
            $banner = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&h=600&q=80';
        }

        if ($template === 'modern') {
            $projects = [
                [
                    'title' => 'Feel Beautiful Inside and Out',
                    'description' => 'Tutorials • Unpacking • Honest Reviews',
                    'link' => '#',
                    'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=600&h=400&q=80'
                ],
                [
                    'title' => 'Holistic Approach in Everything',
                    'description' => 'Amazon Picks • Everyday Life • Useful Tips',
                    'link' => '#',
                    'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&h=400&q=80'
                ]
            ];
        } elseif ($template === 'minimal') {
            $projects = [
                [
                    'title' => 'Residential Design',
                    'description' => 'Detailed construction blueprints and high-fidelity wood-panel facades tailored for modern living.',
                    'link' => '#',
                    'image' => '/b12.png'
                ],
                [
                    'title' => 'Commercial Development',
                    'description' => 'Complete project supervision and structural optimization for mixed-use corporate buildings.',
                    'link' => '#',
                    'image' => '/b13.png'
                ]
            ];
        } elseif ($template === 'developer') {
            $projects = [
                [
                    'title' => 'Bedroom Design',
                    'description' => 'A comfortable space styled precisely for your deep relaxation and mindfulness.',
                    'link' => '#',
                    'image' => '/b12.png'
                ],
                [
                    'title' => 'Living Room Layout',
                    'description' => 'Enjoy cozy, beautiful evenings with your friends and family in open layouts.',
                    'link' => '#',
                    'image' => '/b13.png'
                ],
                [
                    'title' => 'Velvet Chair',
                    'description' => 'Floating hero velvet chair asset',
                    'link' => '#',
                    'image' => '/b18.png'
                ],
                [
                    'title' => 'Pendant Lamp',
                    'description' => 'Floating hero pendant lamp asset',
                    'link' => '#',
                    'image' => '/b19.png'
                ]
            ];
        } else {
            $projects = [
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
            ];
        }

        if ($template === 'modern') {
            $skills = ['Explore', 'Learn'];
        } elseif ($template === 'minimal') {
            $skills = ['Architecture', 'Interior Design', 'Building Design', '3D Rendering', 'Supervision'];
        } elseif ($template === 'developer') {
            $skills = ['Bedroom', 'Living Room', 'Kitchen', 'Bathroom'];
        } else {
            $skills = ['User Experience', 'Web Design', 'Branding', 'Interface Engineering'];
        }

        if ($portfolio) {
            $portfolio->update([
                'template_name' => $template,
                'theme_color' => 'default',
                'title' => $title,
                'bio' => $bio,
                'about_text' => $aboutText,
                'avatar' => $avatar,
                'banner' => $banner,
                'skills' => $skills,
                'projects' => $projects,
            ]);
        } else {
            $portfolio = Portfolio::create([
                'user_id' => $user->id,
                'template_name' => $template,
                'theme_color' => 'default',
                'title' => $title,
                'bio' => $bio,
                'about_text' => $aboutText,
                'avatar' => $avatar,
                'banner' => $banner,
                'skills' => $skills,
                'projects' => $projects,
                'social_links' => [
                    'youtube' => 'https://youtube.com',
                    'twitter' => 'https://twitter.com'
                ],
                'slug' => $slug,
                'is_live' => false,
            ]);
        }

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
