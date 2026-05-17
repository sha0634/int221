<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} - Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    @php
        $colors = ['default' => '#111827', 'blue' => '#2563EB', 'green' => '#059669'];
        $primaryColor = $colors[$portfolio->theme_color] ?? $colors['default'];
    @endphp
    <style>
        :root {
            --primary: {{ $primaryColor }};
            --bg-light: #F9FAFB;
            --text-main: #1F2937;
            --text-muted: #6B7280;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { color: var(--text-main); line-height: 1.6; background: #ffffff; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 2rem; }
        
        /* Header / Hero */
        header { padding: 6rem 0; background: var(--bg-light); border-bottom: 1px solid #E5E7EB; text-align: center; }
        
        .avatar-frame {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1.5rem auto;
            border: 4px solid white;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1);
        }
        .avatar-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        h1 { font-size: 3.5rem; font-weight: 800; color: var(--primary); margin-bottom: 1rem; letter-spacing: -0.05em; }
        .bio { font-size: 1.5rem; color: var(--text-muted); font-weight: 300; max-width: 600px; margin: 0 auto; }
        
        /* Sections */
        section { padding: 6rem 0; border-bottom: 1px solid #E5E7EB; }
        .section-title { font-size: 1.5rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: var(--primary); margin-bottom: 3rem; text-align: center; }
        
        /* About */
        .about-text { max-width: 800px; margin: 0 auto; font-size: 1.125rem; text-align: center; }
        
        /* Skills */
        .skills-grid { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; max-width: 800px; margin: 0 auto; }
        .skill-tag { padding: 0.75rem 1.5rem; background: var(--bg-light); border: 1px solid #E5E7EB; border-radius: 999px; font-weight: 600; color: var(--primary); }
        
        /* Projects */
        .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .project-card { border: 1px solid #E5E7EB; border-radius: 12px; padding: 1.5rem; transition: transform 0.2s, box-shadow 0.2s; background: white; overflow: hidden; }
        .project-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        
        .project-image {
            height: 180px;
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 1.5rem;
        }
        
        .project-card h3 { font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--primary); }
        .project-card p { color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem; }
        .project-link { color: var(--primary); font-weight: 600; text-decoration: none; border-bottom: 2px solid transparent; transition: border-color 0.2s; }
        .project-link:hover { border-color: var(--primary); }
        
        /* Footer */
        footer { padding: 4rem 0; text-align: center; background: var(--primary); color: white; }
        .social-links { display: flex; justify-content: center; gap: 2rem; margin-bottom: 2rem; }
        .social-link { color: white; text-decoration: none; font-weight: 600; font-size: 1.125rem; opacity: 0.8; transition: opacity 0.2s; text-transform: capitalize; }
        .social-link:hover { opacity: 1; }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <div class="avatar-frame">
                <img src="{{ $portfolio->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80' }}" data-editable-img="avatar">
            </div>
            <h1 data-editable="title">{{ $portfolio->title }}</h1>
            @if($portfolio->bio || ($isEditing ?? false))
                <p class="bio" data-editable="bio">{{ $portfolio->bio ?? 'Bio Tagline' }}</p>
            @endif
        </div>
    </header>

    <section>
        <div class="container">
            <h2 class="section-title">About</h2>
            <div class="about-text" data-editable="about_text">
                {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : 'Write a little about yourself here...' !!}
            </div>
        </div>
    </section>

    @if(($portfolio->skills && count($portfolio->skills) > 0) || ($isEditing ?? false))
    <section>
        <div class="container">
            <h2 class="section-title">Expertise</h2>
            <div class="skills-grid">
                @if($portfolio->skills)
                    @foreach($portfolio->skills as $skill)
                        <span class="skill-tag">{{ $skill }}</span>
                    @endforeach
                @else
                    <span class="skill-tag">Design</span>
                    <span class="skill-tag">Development</span>
                @endif
            </div>
        </div>
    </section>
    @endif

    @if(($portfolio->projects && count($portfolio->projects) > 0) || ($isEditing ?? false))
    <section style="background: var(--bg-light);">
        <div class="container">
            <h2 class="section-title">Selected Works</h2>
            <div class="projects-grid">
                @if($portfolio->projects)
                    @foreach($portfolio->projects as $index => $project)
                        <div class="project-card">
                            <img class="project-image" src="{{ $project['image'] ?? 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80' }}" data-editable-img="projects.{{ $index }}.image">
                            <h3 data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                            <p data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</p>
                            @if(isset($project['link']) && $project['link'])
                                <a href="{{ $project['link'] }}" target="_blank" class="project-link">View Project &rarr;</a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Contact/Inquiry Section -->
    <section style="background: #ffffff;">
        <div class="container" style="max-width: 600px;">
            <h2 class="section-title">Get in touch</h2>
            
            @if(session('success'))
                <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center; font-weight: 500;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        <label style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted);">Your Name</label>
                        <input type="text" name="client_name" required style="padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#D1D5DB'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        <label style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted);">Your Email</label>
                        <input type="email" name="client_email" required style="padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#D1D5DB'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted);">Subject</label>
                    <input type="text" name="subject" required style="padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#D1D5DB'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted);">Message</label>
                    <textarea name="message" rows="4" required style="padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border 0.2s; resize: vertical;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#D1D5DB'" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                </div>
                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 0.85rem; border-radius: 8px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: opacity 0.2s; text-transform: uppercase; letter-spacing: 0.05em;" {{ ($isEditing ?? false) ? 'disabled' : '' }} onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    {{ ($isEditing ?? false) ? 'Inquiry Form (Disabled in Editor)' : 'Send Inquiry' }}
                </button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="social-links">
                @if($portfolio->social_links)
                    @foreach($portfolio->social_links as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="social-link" data-editable="social_links.{{ $platform }}">{{ $platform }}</a>
                    @endforeach
                @endif
            </div>
            <p style="opacity: 0.6; font-size: 0.875rem;">&copy; {{ date('Y') }} {{ $portfolio->title }}. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
