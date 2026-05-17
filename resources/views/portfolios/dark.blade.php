<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&display=swap" rel="stylesheet">
    @php
        $colors = ['default' => '#121212', 'neon-green' => '#39FF14', 'neon-blue' => '#00FFFF'];
        $accentColor = $colors[$portfolio->theme_color] ?? $colors['default'];
        if ($portfolio->theme_color == 'default') {
            $accentColor = '#FFFFFF';
        }
    @endphp
    <style>
        :root { --bg: #0A0A0A; --surface: #171717; --text: #E5E5E5; --muted: #A3A3A3; --accent: {{ $accentColor }}; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Space Grotesk', sans-serif; }
        body { background-color: var(--bg); color: var(--text); line-height: 1.6; }
        
        .container { max-width: 1000px; margin: 0 auto; padding: 0 2rem; }
        
        /* Typography */
        h1, h2, h3 { color: #FFFFFF; font-weight: 700; }
        h1 { font-size: 4rem; letter-spacing: -0.05em; line-height: 1.1; margin-bottom: 1.5rem; }
        .accent-text { color: var(--accent); text-shadow: 0 0 20px rgba(var(--accent), 0.5); }
        
        /* Layout */
        .section { padding: 6rem 0; border-bottom: 1px solid #262626; }
        .section-title { font-size: 2rem; margin-bottom: 3rem; display: flex; align-items: center; gap: 1rem; }
        .section-title::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--accent), transparent); opacity: 0.3; }
        
        /* Dark Avatar */
        .dark-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent);
            margin-bottom: 2rem;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
        }

        /* Header */
        header { padding: 6rem 0 4rem; }
        .bio { font-size: 1.5rem; color: var(--muted); max-width: 600px; font-weight: 300; border-left: 2px solid var(--accent); padding-left: 1.5rem; margin-top: 2rem; }
        
        /* About */
        .about-text { font-size: 1.125rem; color: var(--muted); max-width: 800px; }
        
        /* Skills */
        .skills-container { display: flex; flex-wrap: wrap; gap: 1rem; }
        .skill-tag { padding: 0.5rem 1.25rem; background: var(--surface); border: 1px solid #262626; border-radius: 4px; color: var(--text); transition: all 0.3s; }
        .skill-tag:hover { border-color: var(--accent); color: var(--accent); }
        
        /* Projects */
        .project-card { background: var(--surface); border-radius: 8px; padding: 2rem; margin-bottom: 2rem; border: 1px solid #262626; position: relative; overflow: hidden; transition: all 0.3s; }
        .project-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--accent); transform: scaleY(0); transition: transform 0.3s; transform-origin: bottom; }
        .project-card:hover::before { transform: scaleY(1); }
        .project-card:hover { transform: translateX(10px); border-color: #404040; }
        
        .project-img-dark {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            border: 1px solid #262626;
        }

        .project-title { font-size: 1.5rem; margin-bottom: 1rem; }
        .project-desc { color: var(--muted); margin-bottom: 1.5rem; font-size: 1.1rem; }
        .project-link { display: inline-flex; align-items: center; gap: 0.5rem; color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.1em; }
        
        /* Footer */
        footer { padding: 4rem 0; text-align: center; }
        .socials { display: flex; justify-content: center; gap: 2rem; margin-bottom: 2rem; }
        .socials a { color: var(--muted); text-decoration: none; transition: color 0.3s; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.1em; }
        .socials a:hover { color: var(--accent); }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img class="dark-avatar" src="{{ $portfolio->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80' }}" data-editable-img="avatar">
            <h1 data-editable="title">{{ $portfolio->title }}</h1>
            @if($portfolio->bio || ($isEditing ?? false))
            <div class="bio" data-editable="bio">
                {{ $portfolio->bio }}
            </div>
            @endif
        </header>

        <div class="section">
            <h2 class="section-title">01. Background</h2>
            <div class="about-text" data-editable="about_text">
                {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : 'Write about yourself...' !!}
            </div>
        </div>

        @if(($portfolio->skills && count($portfolio->skills) > 0) || ($isEditing ?? false))
        <div class="section">
            <h2 class="section-title">02. Stack</h2>
            <div class="skills-container">
                @if($portfolio->skills)
                    @foreach($portfolio->skills as $skill)
                        <div class="skill-tag">{{ $skill }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        @if(($portfolio->projects && count($portfolio->projects) > 0) || ($isEditing ?? false))
        <div class="section">
            <h2 class="section-title">03. Work</h2>
            <div>
                @if($portfolio->projects)
                    @foreach($portfolio->projects as $index => $project)
                        <div class="project-card">
                            <img class="project-img-dark" src="{{ $project['image'] ?? 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80' }}" data-editable-img="projects.{{ $index }}.image">
                            <h3 class="project-title" data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                            <p class="project-desc" data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</p>
                            @if(isset($project['link']) && $project['link'])
                                <a href="{{ $project['link'] }}" target="_blank" class="project-link">
                                    Launch Project 
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- Dark themed Cyber Inquiry Section -->
        <div class="section" style="border-bottom: none;">
            <h2 class="section-title">04. Inquire</h2>
            
            @if(session('success'))
                <div style="background: var(--surface); border: 1px solid #10B981; color: #10B981; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; font-size: 0.95rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" style="background: var(--surface); border: 1px solid #262626; padding: 2.5rem; border-radius: 8px; display: flex; flex-direction: column; gap: 1.5rem; max-width: 700px; transition: border-color 0.3s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='#262626'">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted);">Sender Name</label>
                        <input type="text" name="client_name" required style="background: var(--bg); border: 1px solid #262626; padding: 0.75rem; border-radius: 4px; color: #FFFFFF; font-size: 0.95rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='#262626'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted);">Sender Email</label>
                        <input type="email" name="client_email" required style="background: var(--bg); border: 1px solid #262626; padding: 0.75rem; border-radius: 4px; color: #FFFFFF; font-size: 0.95rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='#262626'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted);">Subject</label>
                    <input type="text" name="subject" required style="background: var(--bg); border: 1px solid #262626; padding: 0.75rem; border-radius: 4px; color: #FFFFFF; font-size: 0.95rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='#262626'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted);">Message Body</label>
                    <textarea name="message" rows="4" required style="background: var(--bg); border: 1px solid #262626; padding: 0.75rem; border-radius: 4px; color: #FFFFFF; font-size: 0.95rem; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='#262626'" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                </div>
                <button type="submit" style="background: var(--accent); color: #000000; border: none; padding: 1rem; border-radius: 4px; font-weight: 700; font-size: 0.9rem; cursor: pointer; text-transform: uppercase; letter-spacing: 0.15em; transition: all 0.3s; box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);" {{ ($isEditing ?? false) ? 'disabled' : '' }} onmouseover="this.style.boxShadow='0 0 15px var(--accent)';" onmouseout="this.style.boxShadow='none';">
                    {{ ($isEditing ?? false) ? 'Inquiry Form (Disabled)' : 'Transmit Inquiry' }}
                </button>
            </form>
        </div>

        <footer>
            <div class="socials">
                @if($portfolio->social_links)
                    @foreach($portfolio->social_links as $platform => $url)
                        <a href="{{ $url }}" target="_blank" data-editable="social_links.{{ $platform }}">{{ $platform }}</a>
                    @endforeach
                @endif
            </div>
        </footer>
    </div>
</body>
</html>
