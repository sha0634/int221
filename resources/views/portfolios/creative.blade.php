<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">
    @php
        $colors = ['default' => '#EC4899', 'orange' => '#F97316', 'purple' => '#8B5CF6'];
        $primaryColor = $colors[$portfolio->theme_color] ?? $colors['default'];
    @endphp
    <style>
        :root { --primary: {{ $primaryColor }}; --bg: #FAFAF9; --text: #1C1917; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg); color: var(--text); overflow-x: hidden; }
        
        /* Layout */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; position: relative; }
        
        /* Decorative Elements */
        .blob { position: absolute; filter: blur(60px); opacity: 0.5; z-index: -1; }
        .blob-1 { top: -10%; left: -10%; width: 400px; height: 400px; background: var(--primary); border-radius: 50%; }
        .blob-2 { bottom: 10%; right: -5%; width: 500px; height: 500px; background: #FCD34D; border-radius: 50%; }
        
        /* Header */
        header { min-height: 80vh; display: flex; flex-direction: column; justify-content: center; padding-top: 4rem; }
        
        .creative-avatar-frame {
            width: 130px;
            height: 130px;
            border-radius: 28px;
            overflow: hidden;
            border: 4px solid var(--text);
            box-shadow: 8px 8px 0 var(--primary);
            margin-bottom: 2rem;
            transform: rotate(-3deg);
            background: white;
        }
        .creative-avatar-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h1 { font-size: clamp(3rem, 8vw, 6rem); font-weight: 900; line-height: 1; margin-bottom: 1.5rem; text-transform: uppercase; }
        .bio-box { background: white; padding: 2rem; border-radius: 24px; box-shadow: 20px 20px 0px var(--primary); max-width: 600px; margin-left: auto; border: 3px solid var(--text); transform: rotate(-2deg); }
        .bio-box p { font-size: 1.5rem; font-weight: 700; }
        
        /* Sections */
        section { padding: 6rem 0; }
        .section-title { font-size: 3rem; font-weight: 900; margin-bottom: 3rem; display: inline-block; background: var(--primary); color: white; padding: 0.5rem 1.5rem; transform: rotate(1deg); }
        
        .about-text { font-size: 1.25rem; line-height: 1.8; max-width: 800px; font-weight: 500; }
        
        /* Skills */
        .skills-container { display: flex; flex-wrap: wrap; gap: 1rem; }
        .skill-pill { padding: 1rem 2rem; background: white; border: 3px solid var(--text); border-radius: 999px; font-size: 1.25rem; font-weight: 700; box-shadow: 4px 4px 0px var(--primary); transition: transform 0.2s; }
        .skill-pill:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px var(--primary); }
        
        /* Projects */
        .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 3rem; }
        .project-card { background: white; border: 3px solid var(--text); border-radius: 24px; padding: 2rem; position: relative; transition: all 0.3s; overflow: hidden; }
        .project-card:nth-child(odd) { box-shadow: 12px 12px 0px #FCD34D; }
        .project-card:nth-child(even) { box-shadow: 12px 12px 0px var(--primary); transform: translateY(2rem); }
        .project-card:hover { transform: translate(-5px, -5px) !important; box-shadow: 17px 17px 0px var(--text) !important; }
        
        .project-img-creative {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 16px;
            border: 3px solid var(--text);
            margin-bottom: 1.5rem;
        }

        .project-card h3 { font-size: 2rem; font-weight: 900; margin-bottom: 1rem; }
        .project-card p { font-size: 1.1rem; margin-bottom: 2rem; font-weight: 500; }
        .btn { display: inline-block; padding: 0.75rem 2rem; background: var(--text); color: white; text-decoration: none; font-weight: 700; border-radius: 999px; text-transform: uppercase; letter-spacing: 1px; transition: background 0.2s; }
        .btn:hover { background: var(--primary); }
        
        /* Footer */
        footer { padding: 4rem 0; border-top: 3px solid var(--text); margin-top: 4rem; text-align: center; }
        .socials { display: flex; justify-content: center; gap: 2rem; margin-bottom: 2rem; }
        .socials a { font-size: 1.5rem; font-weight: 900; color: var(--text); text-decoration: none; text-transform: uppercase; position: relative; }
        .socials a::after { content: ''; position: absolute; bottom: -5px; left: 0; width: 100%; height: 4px; background: var(--primary); transform: scaleX(0); transition: transform 0.3s; transform-origin: right; }
        .socials a:hover::after { transform: scaleX(1); transform-origin: left; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="container">
        <header>
            <div class="creative-avatar-frame">
                <img src="{{ $portfolio->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80' }}" data-editable-img="avatar">
            </div>
            <h1 data-editable="title">{{ $portfolio->title }}</h1>
            @if($portfolio->bio || ($isEditing ?? false))
            <div class="bio-box">
                <p data-editable="bio">{{ $portfolio->bio }}</p>
            </div>
            @endif
        </header>

        <section>
            <h2 class="section-title">Who am I?</h2>
            <div class="about-text" data-editable="about_text">
                {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : 'Write about yourself here...' !!}
            </div>
        </section>

        @if(($portfolio->skills && count($portfolio->skills) > 0) || ($isEditing ?? false))
        <section>
            <h2 class="section-title" style="background: #FCD34D; color: var(--text); transform: rotate(-1deg);">My Toolbox</h2>
            <div class="skills-container">
                @if($portfolio->skills)
                    @foreach($portfolio->skills as $skill)
                        <div class="skill-pill">{{ $skill }}</div>
                    @endforeach
                @endif
            </div>
        </section>
        @endif

        @if(($portfolio->projects && count($portfolio->projects) > 0) || ($isEditing ?? false))
        <section>
            <h2 class="section-title" style="transform: rotate(2deg);">Cool Stuff I Built</h2>
            <div class="projects-grid">
                @if($portfolio->projects)
                    @foreach($portfolio->projects as $index => $project)
                        <div class="project-card">
                            <img class="project-img-creative" src="{{ $project['image'] ?? 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80' }}" data-editable-img="projects.{{ $index }}.image">
                            <h3 data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                            <p data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</p>
                            @if(isset($project['link']) && $project['link'])
                                <a href="{{ $project['link'] }}" target="_blank" class="btn">See Live</a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        @endif

        <!-- Creative Contact/Inquiry Section -->
        <section>
            <h2 class="section-title" style="background: #FCD34D; color: var(--text); transform: rotate(1deg);">Drop a Line</h2>
            
            @if(session('success'))
                <div style="background: white; border: 3px solid var(--text); padding: 1rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 8px 8px 0px #10B981; font-weight: 700;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" style="background: white; border: 3px solid var(--text); padding: 2.5rem; border-radius: 24px; box-shadow: 12px 12px 0px var(--primary); display: flex; flex-direction: column; gap: 1.5rem; max-width: 700px;">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-weight: 700; text-transform: uppercase;">Your Name</label>
                        <input type="text" name="client_name" required style="padding: 0.75rem; border: 3px solid var(--text); border-radius: 12px; font-size: 1.1rem; font-weight: 600; outline: none; background: #FAFAF9;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-weight: 700; text-transform: uppercase;">Your Email</label>
                        <input type="email" name="client_email" required style="padding: 0.75rem; border: 3px solid var(--text); border-radius: 12px; font-size: 1.1rem; font-weight: 600; outline: none; background: #FAFAF9;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; text-transform: uppercase;">Subject</label>
                    <input type="text" name="subject" required style="padding: 0.75rem; border: 3px solid var(--text); border-radius: 12px; font-size: 1.1rem; font-weight: 600; outline: none; background: #FAFAF9;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; text-transform: uppercase;">Message</label>
                    <textarea name="message" rows="4" required style="padding: 0.75rem; border: 3px solid var(--text); border-radius: 12px; font-size: 1.1rem; font-weight: 600; outline: none; background: #FAFAF9; resize: vertical;" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                </div>
                <button type="submit" class="btn" style="border: 3px solid var(--text); cursor: pointer; text-align: center; font-size: 1.1rem; border-radius: 12px; padding: 1rem; width: 100%;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    {{ ($isEditing ?? false) ? 'Inquiry Form (Disabled in Editor)' : 'Send message' }}
                </button>
            </form>
        </section>

        <footer>
            <div class="socials">
                @if($portfolio->social_links)
                    @foreach($portfolio->social_links as $platform => $url)
                        <a href="{{ $url }}" target="_blank" data-editable="social_links.{{ $platform }}">{{ $platform }}</a>
                    @endforeach
                @endif
            </div>
            <h2 style="font-size: 3rem; font-weight: 900;">Let's Create!</h2>
        </footer>
    </div>
</body>
</html>
