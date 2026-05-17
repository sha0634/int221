@extends('layouts.creator')

@section('header_title', isset($portfolio) ? 'Edit Portfolio' : 'Create Portfolio')

@section('styles')
<style>
    .form-section {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--primary);
        font-size: 0.9rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s;
        font-family: inherit;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .color-options {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .color-radio {
        display: none;
    }

    .color-label {
        display: inline-block;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid transparent;
        transition: transform 0.2s, border-color 0.2s;
    }

    .color-radio:checked + .color-label {
        transform: scale(1.1);
        border-color: var(--accent);
        box-shadow: 0 0 0 3px white inset;
    }

    .btn-submit {
        background: var(--accent);
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
    }

    .btn-submit:hover {
        background: var(--accent-hover);
    }

    .dynamic-list-item {
        background: #F8FAFC;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.25rem;
        border: 1px solid #E2E8F0;
        position: relative;
    }

    .remove-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: #FEE2E2;
        color: #DC2626;
        border: none;
        border-radius: 6px;
        padding: 0.4rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .remove-btn:hover {
        background: #FCA5A5;
    }
</style>
@endsection

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('creator.portfolio.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.25rem; font-weight: 500;">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Portfolio Hub
    </a>
</div>

<form action="{{ isset($portfolio) ? route('creator.portfolio.update') : route('creator.portfolio.store', $template ?? '') }}" method="POST">
    @csrf
    @if(isset($portfolio))
        @method('PUT')
    @endif

    <div class="form-section">
        <h2 class="section-title">1. Basic Information</h2>
        
        @if(!isset($portfolio))
        <div class="form-group">
            <label class="form-label">Theme Color Style</label>
            <div class="color-options">
                @php
                    $colors = [
                        'modern' => ['default' => '#111827', 'blue' => '#2563EB', 'green' => '#059669'],
                        'minimal' => ['default' => '#000000', 'gray' => '#4B5563', 'sand' => '#D5BDAF'],
                        'developer' => ['default' => '#1E1E1E', 'dracula' => '#282A36', 'monokai' => '#272822'],
                        'creative' => ['default' => '#EC4899', 'orange' => '#F97316', 'purple' => '#8B5CF6'],
                        'dark' => ['default' => '#121212', 'neon-green' => '#39FF14', 'neon-blue' => '#00FFFF']
                    ];
                    $templateColors = $colors[$template ?? $portfolio->template_name] ?? $colors['modern'];
                @endphp
                @foreach($templateColors as $name => $hex)
                    <input type="radio" name="theme_color" id="color_{{ $name }}" value="{{ $name }}" class="color-radio" {{ $loop->first ? 'checked' : '' }}>
                    <label for="color_{{ $name }}" class="color-label" style="background-color: {{ $hex }};" title="{{ ucfirst($name) }}"></label>
                @endforeach
            </div>
        </div>
        @endif

        <div class="form-group">
            <label class="form-label">Portfolio Title / Headline</label>
            <input type="text" name="title" class="form-control" placeholder="e.g. John Doe - Full Stack Developer" value="{{ old('title', $portfolio->title ?? '') }}" required>
            @error('title')<span style="color: red; font-size: 0.8rem;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Custom URL Slug</label>
            <div style="display: flex; align-items: center;">
                <span style="background: #F1F5F9; padding: 0.75rem 1rem; border: 1px solid #CBD5E1; border-right: none; border-radius: 10px 0 0 10px; color: var(--text-muted); font-size: 0.9rem;">{{ url('/portfolio') }}/</span>
                <input type="text" name="slug" class="form-control" style="border-radius: 0 10px 10px 0;" placeholder="john-doe" value="{{ old('slug', $portfolio->slug ?? '') }}" required>
            </div>
            @error('slug')<span style="color: red; font-size: 0.8rem;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Short Bio (Tagline)</label>
            <input type="text" name="bio" class="form-control" placeholder="I design and build beautiful web products." value="{{ old('bio', $portfolio->bio ?? '') }}">
        </div>

        <div class="form-group">
            <label class="form-label">About Me (Full Text)</label>
            <textarea name="about_text" class="form-control" placeholder="Tell the world about your journey, expertise, and what drives you.">{{ old('about_text', $portfolio->about_text ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Skills (Comma separated list)</label>
            <input type="text" name="skills" class="form-control" placeholder="PHP, Laravel, JavaScript, Vue.js, Tailwind CSS" value="{{ old('skills', isset($portfolio) && $portfolio->skills ? implode(', ', $portfolio->skills) : '') }}">
        </div>
    </div>

    <div class="form-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 class="section-title" style="margin-bottom: 0;">2. Projects</h2>
            <button type="button" id="add-project" style="padding: 0.55rem 1rem; background: #EEF2FF; color: var(--accent); border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.85rem;">+ Add Project</button>
        </div>
        
        <div id="projects-container">
            @php 
                $projects = old('project_titles', isset($portfolio) && $portfolio->projects ? $portfolio->projects : [['title' => '', 'description' => '', 'link' => '']]); 
            @endphp
            @foreach($projects as $index => $project)
            <div class="dynamic-list-item">
                @if($index > 0)
                <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Remove</button>
                @endif
                <div class="form-group">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="project_titles[]" class="form-control" value="{{ is_array($project) ? ($project['title'] ?? '') : $project }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Project Description</label>
                    <textarea name="project_descriptions[]" class="form-control" rows="2">{{ is_array($project) ? ($project['description'] ?? '') : (old("project_descriptions.$index") ?? '') }}</textarea>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Project URL Link</label>
                    <input type="url" name="project_links[]" class="form-control" placeholder="https://" value="{{ is_array($project) ? ($project['link'] ?? '') : (old("project_links.$index") ?? '') }}">
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="form-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 class="section-title" style="margin-bottom: 0;">3. Social Links</h2>
            <button type="button" id="add-social" style="padding: 0.55rem 1rem; background: #EEF2FF; color: var(--accent); border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.85rem;">+ Add Social Link</button>
        </div>
        <div id="socials-container">
            @php 
                $socials = old('social_platforms', isset($portfolio) && $portfolio->social_links ? array_keys($portfolio->social_links) : ['']);
                $urls = old('social_urls', isset($portfolio) && $portfolio->social_links ? array_values($portfolio->social_links) : ['']);
            @endphp
            @foreach($socials as $index => $platform)
            <div class="dynamic-list-item" style="display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; padding-top: 1rem;">
                <div style="flex: 1;">
                    <select name="social_platforms[]" class="form-control">
                        <option value="">Select Platform</option>
                        <option value="github" {{ $platform == 'github' ? 'selected' : '' }}>GitHub</option>
                        <option value="linkedin" {{ $platform == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                        <option value="twitter" {{ $platform == 'twitter' ? 'selected' : '' }}>Twitter / X</option>
                        <option value="dribbble" {{ $platform == 'dribbble' ? 'selected' : '' }}>Dribbble</option>
                        <option value="behance" {{ $platform == 'behance' ? 'selected' : '' }}>Behance</option>
                        <option value="instagram" {{ $platform == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    </select>
                </div>
                <div style="flex: 2;">
                    <input type="url" name="social_urls[]" class="form-control" placeholder="https://" value="{{ $urls[$index] ?? '' }}">
                </div>
                @if($index > 0)
                <button type="button" class="remove-btn" style="position: static; padding: 0.75rem 1rem;" onclick="this.parentElement.remove()">X</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <div class="form-section">
        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
            <input type="checkbox" name="is_live" value="1" style="width: 22px; height: 22px; accent-color: var(--accent);" {{ old('is_live', $portfolio->is_live ?? false) ? 'checked' : '' }}>
            <span style="font-weight: 600; color: var(--primary); font-size: 0.95rem;">Publish portfolio immediately (Make it live)</span>
        </label>
    </div>

    <button type="submit" class="btn-submit">{{ isset($portfolio) ? 'Save Changes' : 'Create Portfolio' }}</button>
</form>

<script>
    document.getElementById('add-project').addEventListener('click', function() {
        const container = document.getElementById('projects-container');
        const newItem = document.createElement('div');
        newItem.className = 'dynamic-list-item';
        newItem.innerHTML = `
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Remove</button>
            <div class="form-group">
                <label class="form-label">Project Title</label>
                <input type="text" name="project_titles[]" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Project Description</label>
                <textarea name="project_descriptions[]" class="form-control" rows="2"></textarea>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Project URL Link</label>
                <input type="url" name="project_links[]" class="form-control" placeholder="https://">
            </div>
        `;
        container.appendChild(newItem);
    });

    document.getElementById('add-social').addEventListener('click', function() {
        const container = document.getElementById('socials-container');
        const newItem = document.createElement('div');
        newItem.className = 'dynamic-list-item';
        newItem.style.cssText = 'display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; padding-top: 1rem;';
        newItem.innerHTML = `
            <div style="flex: 1;">
                <select name="social_platforms[]" class="form-control">
                    <option value="">Select Platform</option>
                    <option value="github">GitHub</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="twitter">Twitter / X</option>
                    <option value="dribbble">Dribbble</option>
                    <option value="behance">Behance</option>
                    <option value="instagram">Instagram</option>
                </select>
            </div>
            <div style="flex: 2;">
                <input type="url" name="social_urls[]" class="form-control" placeholder="https://">
            </div>
            <button type="button" class="remove-btn" style="position: static; padding: 0.75rem 1rem;" onclick="this.parentElement.remove()">X</button>
        `;
        container.appendChild(newItem);
    });
</script>
@endsection
