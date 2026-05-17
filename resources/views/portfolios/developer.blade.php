<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&display=swap" rel="stylesheet">
    @php
        $colors = ['default' => '#1E1E1E', 'dracula' => '#282A36', 'monokai' => '#272822'];
        $bg = $colors[$portfolio->theme_color] ?? $colors['default'];
        $text = '#A9B7C6';
        $accent = '#FFC66D';
        $keyword = '#CC7832';
        $string = '#6A8759';
        if ($portfolio->theme_color == 'dracula') {
            $text = '#F8F8F2'; $accent = '#FF79C6'; $keyword = '#8BE9FD'; $string = '#F1FA8C';
        } elseif ($portfolio->theme_color == 'monokai') {
            $text = '#F8F8F2'; $accent = '#FD971F'; $keyword = '#F92672'; $string = '#E6DB74';
        }
    @endphp
    <style>
        body { margin: 0; padding: 2rem; background-color: {{ $bg }}; color: {{ $text }}; font-family: 'Fira Code', monospace; line-height: 1.6; }
        .container { max-width: 800px; margin: 0 auto; }
        .prompt::before { content: '~$ '; color: {{ $keyword }}; }
        .keyword { color: {{ $keyword }}; }
        .string { color: {{ $string }}; }
        .function { color: {{ $accent }}; }
        .comment { color: #808080; font-style: italic; }
        
        h1 { margin-bottom: 2rem; font-size: 2rem; }
        .block { margin-bottom: 3rem; background: rgba(0,0,0,0.2); padding: 1.5rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); }
        
        /* Developer Avatar */
        .dev-avatar {
            width: 70px;
            height: 70px;
            border-radius: 6px;
            border: 2px solid {{ $accent }};
            object-fit: cover;
            margin-bottom: 1.5rem;
        }

        .project-img-dev {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 1rem;
            border: 1px solid rgba(255,255,255,0.1);
        }

        a { color: {{ $keyword }}; text-decoration: none; }
        a:hover { text-decoration: underline; }
        
        .typewriter h1 { overflow: hidden; border-right: .15em solid {{ $accent }}; white-space: nowrap; margin: 0 auto; letter-spacing: .15em; animation: typing 2.5s steps(40, end), blink-caret .75s step-end infinite; }
        @keyframes typing { from { width: 0 } to { width: 100% } }
        @keyframes blink-caret { from, to { border-color: transparent } 50% { border-color: {{ $accent }}; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="block">
            <img class="dev-avatar" src="{{ $portfolio->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=256&h=256&q=80' }}" data-editable-img="avatar">
            <br>
            <span class="comment">// <span data-editable="title">{{ $portfolio->title }}</span></span><br>
            @if($portfolio->bio || ($isEditing ?? false))
            <span class="comment">// <span data-editable="bio">{{ $portfolio->bio ?? 'My Tagline' }}</span></span><br><br>
            @endif
            <span class="keyword">const</span> <span class="function">developer</span> = {<br>
            &nbsp;&nbsp;name: <span class="string">'<span data-editable="title">{{ $portfolio->title }}</span>'</span>,<br>
            &nbsp;&nbsp;status: <span class="string">'Online'</span>
            <br>};
        </div>

        <div class="block">
            <div class="prompt"><span class="function">cat</span> about.txt</div>
            <div style="margin-top: 1rem;" data-editable="about_text">
                {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : 'Write your bio here...' !!}
            </div>
        </div>

        @if(($portfolio->skills && count($portfolio->skills) > 0) || ($isEditing ?? false))
        <div class="block">
            <div class="prompt"><span class="function">ls</span> skills/</div>
            <div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 0.5rem;">
                @if($portfolio->skills)
                    @foreach($portfolio->skills as $skill)
                        <div><span class="string">├──</span> {{ $skill }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        @if(($portfolio->projects && count($portfolio->projects) > 0) || ($isEditing ?? false))
        <div class="block">
            <div class="prompt"><span class="function">npm</span> run show-projects</div>
            <div style="margin-top: 1rem;">
                [<br>
                @if($portfolio->projects)
                    @foreach($portfolio->projects as $index => $project)
                    &nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;preview: <span class="string"><img class="project-img-dev" src="{{ $project['image'] ?? 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80' }}" data-editable-img="projects.{{ $index }}.image"></span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;title: <span class="string">'<span data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</span>'</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;description: <span class="string">'<span data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</span>'</span>,<br>
                    @if(isset($project['link']) && $project['link'])
                    &nbsp;&nbsp;&nbsp;&nbsp;url: <a href="{{ $project['link'] }}" target="_blank" class="string">'{{ $project['link'] }}'</a><br>
                    @endif
                    &nbsp;&nbsp;}{{ !$loop->last ? ',' : '' }}<br>
                    @endforeach
                @endif
                ]
            </div>
        </div>
        @endif

        @if(($portfolio->social_links && count($portfolio->social_links) > 0) || ($isEditing ?? false))
        <div class="block">
            <div class="prompt"><span class="function">ping</span> socials</div>
            <div style="margin-top: 1rem;">
                @if($portfolio->social_links)
                    @foreach($portfolio->social_links as $platform => $url)
                        Reply from <a href="{{ $url }}" target="_blank" data-editable="social_links.{{ $platform }}">{{ ucfirst($platform) }}</a>: bytes=32 time&lt;1ms TTL=128<br>
                    @endforeach
                @endif
            </div>
        </div>
        @endif
        
        <!-- Terminal styled Contact Block -->
        <div class="block">
            <div class="prompt"><span class="function">sh</span> send-message.sh</div>
            
            @if(session('success'))
                <div style="margin-top: 1rem; color: {{ $string }}; font-weight: bold;">
                    // {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" style="margin-top: 1rem; display: flex; flex-direction: column; gap: 1rem; max-width: 600px;">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <span style="color: {{ $accent }};">clientName</span> = <input type="text" name="client_name" required placeholder='"Your Name"' style="background: none; border: none; border-bottom: 1px dashed {{ $text }}; color: {{ $string }}; font-family: inherit; font-size: 0.95rem; outline: none; width: 80%;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>;
                    </div>
                    <div>
                        <span style="color: {{ $accent }};">clientEmail</span> = <input type="email" name="client_email" required placeholder='"your@email.com"' style="background: none; border: none; border-bottom: 1px dashed {{ $text }}; color: {{ $string }}; font-family: inherit; font-size: 0.95rem; outline: none; width: 80%;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>;
                    </div>
                </div>
                <div>
                    <span style="color: {{ $accent }};">subject</span> = <input type="text" name="subject" required placeholder='"Subject of inquiry"' style="background: none; border: none; border-bottom: 1px dashed {{ $text }}; color: {{ $string }}; font-family: inherit; font-size: 0.95rem; outline: none; width: 85%;" {{ ($isEditing ?? false) ? 'disabled' : '' }}>;
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                    <span style="color: {{ $accent }};">message</span> = <textarea name="message" rows="3" required placeholder='"Type message details here..."' style="flex: 1; background: none; border: none; border-bottom: 1px dashed {{ $text }}; color: {{ $string }}; font-family: inherit; font-size: 0.95rem; outline: none; resize: vertical;" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>;
                </div>
                <button type="submit" style="background: none; border: 1px solid {{ $accent }}; color: {{ $accent }}; padding: 0.5rem 1rem; font-family: inherit; font-size: 0.9rem; border-radius: 4px; cursor: pointer; transition: all 0.2s; align-self: flex-start;" {{ ($isEditing ?? false) ? 'disabled' : '' }} onmouseover="this.style.backgroundColor='{{ $accent }}'; this.style.color='{{ $bg }}';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $accent }}';">
                    {{ ($isEditing ?? false) ? 'Inquiry Form (Disabled)' : './execute_send' }}
                </button>
            </form>
        </div>
        
        <div class="prompt"><span class="function">exit</span><span style="animation: blink-caret 1s step-end infinite;">_</span></div>
    </div>
</body>
</html>
