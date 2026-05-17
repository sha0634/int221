<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Helvetica+Neue:wght@300;400;500&display=swap" rel="stylesheet">
    @php
        $colors = ['default' => '#000000', 'gray' => '#4B5563', 'sand' => '#D5BDAF'];
        $primaryColor = $colors[$portfolio->theme_color] ?? $colors['default'];
    @endphp
    <style>
        :root {
            --primary: {{ $primaryColor }};
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        body { color: var(--primary); line-height: 1.8; background: #ffffff; padding: 4vw; }
        
        .container { max-width: 900px; margin: 0 auto; }
        
        /* Typography */
        h1 { font-size: 4vw; font-weight: 400; margin-bottom: 2rem; letter-spacing: -0.02em; line-height: 1.1; }
        @media (max-width: 768px) { h1 { font-size: 2.5rem; } }
        
        p { font-size: 1.2rem; font-weight: 300; margin-bottom: 1.5rem; color: #555; max-width: 700px; }
        
        /* Layout */
        .section { margin-bottom: 6rem; }
        .section-header { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.2em; border-bottom: 1px solid #eaeaea; padding-bottom: 1rem; margin-bottom: 3rem; }
        
        /* Avatar Minimal */
        .avatar-minimal {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 2rem;
            filter: grayscale(1);
            transition: filter 0.3s;
        }
        .avatar-minimal:hover {
            filter: grayscale(0);
        }

        /* List */
        .simple-list { list-style: none; display: flex; flex-wrap: wrap; gap: 2rem; }
        .simple-list li { font-size: 1.1rem; border-bottom: 1px solid var(--primary); padding-bottom: 0.2rem; }
        
        /* Projects */
        .project-item { margin-bottom: 4rem; display: flex; gap: 2rem; align-items: flex-start; }
        @media (max-width: 768px) {
            .project-item { flex-direction: column; }
        }
        .project-img-minimal {
            width: 200px;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
        }
        .project-details { flex: 1; }
        .project-title { font-size: 2rem; font-weight: 400; }
        .project-desc { font-size: 1.1rem; color: #666; margin-bottom: 0; }
        .project-link { display: inline-block; margin-top: 1rem; color: var(--primary); text-decoration: none; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 1px solid transparent; transition: border-color 0.3s; }
        .project-link:hover { border-color: var(--primary); }
        
        /* Socials */
        .socials { display: flex; gap: 2rem; margin-top: 4rem; }
        .socials a { color: var(--primary); text-decoration: none; font-size: 1.1rem; }
        .socials a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="container">
        <header class="section" style="margin-top: 5vh;">
            <img class="avatar-minimal" src="{{ $portfolio->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80' }}" data-editable-img="avatar">
            <h1 data-editable="title">{{ $portfolio->title }}</h1>
            @if($portfolio->bio || ($isEditing ?? false))
                <p style="color: var(--primary); font-size: 1.5rem;" data-editable="bio">{{ $portfolio->bio }}</p>
            @endif
        </header>

        <div class="section">
            <h2 class="section-header">Profile</h2>
            <div style="font-size: 1.2rem; line-height: 1.8; color: #333; max-width: 800px;" data-editable="about_text">
                {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : 'Write your details here...' !!}
            </div>
        </div>

        @if(($portfolio->skills && count($portfolio->skills) > 0) || ($isEditing ?? false))
        <div class="section">
            <h2 class="section-header">Capabilities</h2>
            <ul class="simple-list">
                @if($portfolio->skills)
                    @foreach($portfolio->skills as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
        @endif

        @if(($portfolio->projects && count($portfolio->projects) > 0) || ($isEditing ?? false))
        <div class="section">
            <h2 class="section-header">Index</h2>
            <div>
                @if($portfolio->projects)
                    @foreach($portfolio->projects as $index => $project)
                        <div class="project-item">
                            <img class="project-img-minimal" src="{{ $project['image'] ?? 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80' }}" data-editable-img="projects.{{ $index }}.image">
                            <div class="project-details">
                                <h3 class="project-title" data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                                <p class="project-desc" data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</p>
                                @if(isset($project['link']) && $project['link'])
                                    <div><a href="{{ $project['link'] }}" target="_blank" class="project-link">View Project</a></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        <footer class="section" style="margin-bottom: 2rem;">
            <h2 class="section-header">Contact</h2>
            
            @if(session('success'))
                <div style="background: #FAFAFA; border: 1px solid var(--primary); color: var(--primary); padding: 1rem; border-radius: 4px; margin-bottom: 2rem; font-size: 0.95rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 600px; margin-bottom: 3rem;">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                        <input type="text" name="client_name" required placeholder="Name" style="background: none; border: none; border-bottom: 1px solid #ccc; padding: 0.5rem 0; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#ccc'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                        <input type="email" name="client_email" required placeholder="Email" style="background: none; border: none; border-bottom: 1px solid #ccc; padding: 0.5rem 0; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#ccc'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                </div>
                <div>
                    <input type="text" name="subject" required placeholder="Subject" style="width: 100%; background: none; border: none; border-bottom: 1px solid #ccc; padding: 0.5rem 0; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#ccc'" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                </div>
                <div>
                    <textarea name="message" rows="3" required placeholder="Message" style="width: 100%; background: none; border: none; border-bottom: 1px solid #ccc; padding: 0.5rem 0; font-size: 1rem; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#ccc'" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                </div>
                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 0.8rem; border-radius: 4px; font-weight: 500; font-size: 0.95rem; cursor: pointer; text-transform: uppercase; letter-spacing: 0.1em; transition: opacity 0.2s;" {{ ($isEditing ?? false) ? 'disabled' : '' }} onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                    {{ ($isEditing ?? false) ? 'Inquiry Form (Disabled in Editor)' : 'Send message' }}
                </button>
            </form>

            <div class="socials">
                @if($portfolio->social_links)
                    @foreach($portfolio->social_links as $platform => $url)
                        <a href="{{ $url }}" target="_blank" data-editable="social_links.{{ $platform }}">{{ ucfirst($platform) }}</a>
                    @endforeach
                @endif
            </div>
        </footer>
    </div>

</body>
</html>
