@extends('layouts.creator')

@section('header_title', $portfolio ? 'My Portfolio' : 'Choose a Template')

@section('styles')
<style>
    /* Gallery Styles */
    .templates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 1rem;
    }
    
    .template-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    
    .template-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.1);
        border-color: #CBD5E1;
    }
    
    .template-preview {
        height: 180px;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-bottom: 1px solid #E2E8F0;
    }

    .template-preview::before {
        content: '';
        position: absolute;
        top: 10px;
        left: 10px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ef4444;
        box-shadow: 12px 0 0 #f59e0b, 24px 0 0 #10b981;
    }
    
    .template-info {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .template-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--primary);
    }
    
    .template-desc {
        color: var(--text-muted);
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        flex: 1;
    }
    
    .template-action {
        display: block;
        width: 100%;
        padding: 0.75rem;
        text-align: center;
        background: var(--accent);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background 0.2s;
    }
    
    .template-action:hover {
        background: var(--accent-hover);
    }
</style>
@endsection

@section('content')
    @if(!$portfolio)
        <div style="margin-bottom: 2rem;">
            <p style="color: var(--text-muted); font-size: 1.05rem;">Select a design style to get started building your professional creator portfolio.</p>
        </div>

        <div class="templates-grid">
            @foreach($templates as $template)
            <div class="template-card">
                <div class="template-preview" style="background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);">
                    <span style="font-size: 1.25rem; font-style: italic; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 2px;">{{ $template['name'] }}</span>
                </div>
                <div class="template-info">
                    <h3 class="template-title">{{ $template['name'] }}</h3>
                    <p class="template-desc">{{ $template['description'] }}</p>
                    <a href="{{ route('creator.portfolio.create', $template['id']) }}" class="template-action">Use Template</a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bento-box" style="padding: 2.5rem;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 2rem;">
                <div>
                    <h2 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--primary);">{{ $portfolio->title }}</h2>
                    <p style="color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem;">Template: <span style="font-weight: 600; color: var(--primary); text-transform: capitalize;">{{ str_replace('-', ' ', $portfolio->template_name) }}</span></p>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: white; border: 1px solid #E2E8F0; color: var(--primary); text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            View Live
                        </a>
                        <a href="{{ route('creator.portfolio.editor') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: var(--accent); color: white; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Details (Visual Builder)
                        </a>
                    </div>
                </div>
                
                <div style="background: #F8FAFC; padding: 1.5rem; border-radius: 16px; border: 1px solid #E2E8F0; text-align: center; min-width: 240px;">
                    <h3 style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Status</h3>
                    <div style="margin-bottom: 1.25rem;">
                        @if($portfolio->is_live)
                            <span style="display: inline-flex; align-items: center; gap: 0.5rem; color: #10B981; font-weight: 700; font-size: 1.25rem;">
                                <span style="width: 10px; height: 10px; border-radius: 50%; background: #10B981; box-shadow: 0 0 8px #10B981;"></span> Live
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 0.5rem; color: #F59E0B; font-weight: 700; font-size: 1.25rem;">
                                <span style="width: 10px; height: 10px; border-radius: 50%; background: #F59E0B;"></span> Draft
                            </span>
                        @endif
                    </div>
                    
                    <form action="{{ route('creator.portfolio.toggleLive') }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; padding: 0.65rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; background: {{ $portfolio->is_live ? '#FEE2E2' : '#D1FAE5' }}; color: {{ $portfolio->is_live ? '#DC2626' : '#059669' }};">
                            {{ $portfolio->is_live ? 'Unpublish Portfolio' : 'Publish Portfolio' }}
                        </button>
                    </form>
                </div>
            </div>
            
            <div style="margin-top: 3rem; border-top: 1px solid #E2E8F0; padding-top: 2rem;">
                <h3 style="font-size: 1.1rem; margin-bottom: 0.75rem; color: var(--primary); font-weight: 700;">Public Portfolio Link</h3>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <code style="background: #F1F5F9; padding: 0.85rem 1.25rem; border-radius: 10px; flex: 1; font-family: monospace; color: var(--text-dark); border: 1px solid #E2E8F0; font-size: 0.95rem;">{{ url('/portfolio/' . $portfolio->slug) }}</code>
                    <button onclick="navigator.clipboard.writeText('{{ url('/portfolio/' . $portfolio->slug) }}'); alert('Portfolio link copied to clipboard!');" style="padding: 0.85rem 1.5rem; background: var(--primary); color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: background 0.2s;">Copy Link</button>
                </div>
            </div>

            <!-- Dynamic Template Gallery Switcher -->
            <div style="margin-top: 3.5rem; border-top: 1px solid #E2E8F0; padding-top: 2.5rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">Switch Design Style / Template</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Want to see your content in a different style? Select another premium layout below to instantly switch themes and pre-populate defaults!</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    @php
                        $switchTemplates = [
                            ['id' => 'modern', 'name' => 'Emma Holistic (Design 1)', 'description' => 'Blush-peach warm palette perfect for beauty, food, and wellness.'],
                            ['id' => 'minimal', 'name' => 'Adam Smith Architect (Design 2)', 'description' => 'Minimalist beige architect layout with structured checkmarks and building grids.'],
                            ['id' => 'developer', 'name' => 'Mary Dench Boutique (Design 3)', 'description' => 'Dark concrete interior designer boutique with hanging lights and velvet chairs.'],
                        ];
                    @endphp
                    @foreach($switchTemplates as $tmpl)
                        @if($tmpl['id'] !== $portfolio->template_name)
                        <div style="background: white; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s; border-color: #E2E8F0;" onmouseover="this.style.borderColor='var(--accent)';" onmouseout="this.style.borderColor='#E2E8F0';">
                            <div>
                                <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--primary); margin-bottom: 0.25rem;">{{ $tmpl['name'] }}</h4>
                                <p style="color: var(--text-muted); font-size: 0.8rem; line-height: 1.4; margin-bottom: 1rem;">{{ $tmpl['description'] }}</p>
                            </div>
                            <a href="{{ route('creator.portfolio.create', $tmpl['id']) }}" style="display: block; text-align: center; background: #F1F5F9; color: var(--primary); text-decoration: none; padding: 0.5rem; border-radius: 6px; font-weight: 600; font-size: 0.8rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='var(--accent)'; this.style.color='white';" onmouseout="this.style.backgroundColor='#F1F5F9'; this.style.color='var(--primary)';">
                                Switch to this Style
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
