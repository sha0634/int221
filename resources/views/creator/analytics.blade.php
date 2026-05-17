@extends('layouts.creator')

@section('header_title', 'Portfolio Analytics')

@section('content')
<div style="max-width: 1000px; margin: 0 auto;">

    @if(!$hasPortfolio)
        <div class="bento-box" style="padding: 4rem 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: #EEF2FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                <svg width="28" height="28" fill="none" stroke="var(--accent)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">No portfolio active</h3>
            <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 400px; margin: 0 auto 1.5rem auto;">Please set up your visual portfolio first to start gathering deep visitor analytics!</p>
            <a href="{{ route('creator.portfolio.index') }}" style="display: inline-block; background: var(--accent); color: white; padding: 0.75rem 2rem; border-radius: 10px; font-weight: 600; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='var(--accent-hover)';" onmouseout="this.style.background='var(--accent)';">
                Setup My Portfolio
            </a>
        </div>
    @else
        <!-- Stats Row -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Profile Views -->
            <div class="bento-box" style="padding: 1.5rem; position: relative; overflow: hidden; background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%); border-color: rgba(79, 70, 229, 0.15);">
                <div style="color: #4F46E5; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Views</div>
                <div style="font-size: 2.25rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">{{ number_format($totalViews) }}</div>
                <div style="font-size: 0.8rem; color: #4F46E5; font-weight: 600;">{{ $viewsTrend }}</div>
            </div>

            <!-- Unique Visitors -->
            <div class="bento-box" style="padding: 1.5rem; background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); border-color: rgba(16, 185, 129, 0.15);">
                <div style="color: #059669; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Unique Visitors</div>
                <div style="font-size: 2.25rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">{{ number_format($uniqueVisitors) }}</div>
                <div style="font-size: 0.8rem; color: #059669; font-weight: 600;">Actual browser sessions</div>
            </div>

            <!-- Inquiries Received -->
            <div class="bento-box" style="padding: 1.5rem; background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); border-color: rgba(245, 158, 11, 0.15);">
                <div style="color: #D97706; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Inquiries</div>
                <div style="font-size: 2.25rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">{{ number_format($totalInquiries) }}</div>
                <div style="font-size: 0.8rem; color: #D97706; font-weight: 600;">Opportunities captured</div>
            </div>

            <!-- Response Rate -->
            <div class="bento-box" style="padding: 1.5rem; background: linear-gradient(135deg, #FAF5FF 0%, #F3E8FF 100%); border-color: rgba(168, 85, 247, 0.15);">
                <div style="color: #7C3AED; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Response Rate</div>
                <div style="font-size: 2.25rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">{{ $responseRate }}%</div>
                <div style="font-size: 0.8rem; color: #7C3AED; font-weight: 600;">Inquiries successfully replied</div>
            </div>
        </div>

        <!-- Chart & Platform Breakdown -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            
            <!-- Traffic chart -->
            <div class="bento-box" style="padding: 2rem; display: flex; flex-direction: column;">
                <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">Traffic Overview</h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2rem;">Daily visitor views logged over the last 7 days.</p>
                
                @php
                    $maxCount = collect($viewsByDay)->max('count');
                    $maxHeight = 200; // max chart height in px
                @endphp

                <!-- Chart bars container -->
                <div style="display: flex; align-items: flex-end; justify-content: space-between; height: {{ $maxHeight }}px; padding: 0 1rem; border-bottom: 2px solid #E2E8F0; position: relative;">
                    @foreach($viewsByDay as $dayData)
                        @php
                            $barHeight = $maxCount > 0 ? ($dayData['count'] / $maxCount) * ($maxHeight - 20) : 4;
                            $barHeight = max(4, $barHeight);
                        @endphp
                        <div style="display: flex; flex-direction: column; align-items: center; width: 10%; cursor: pointer;" title="{{ $dayData['count'] }} views">
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--accent); margin-bottom: 0.5rem;">{{ $dayData['count'] }}</span>
                            <div style="width: 100%; height: {{ $barHeight }}px; background: linear-gradient(180deg, var(--accent) 0%, rgba(79, 70, 229, 0.4) 100%); border-radius: 8px 8px 0 0; transition: transform 0.2s;" onmouseover="this.style.transform='scaleY(1.08)';" onmouseout="this.style.transform='scaleY(1)';"></div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Day labels -->
                <div style="display: flex; justify-content: space-between; padding: 0.75rem 1rem 0 1rem; font-size: 0.8rem; font-weight: 700; color: var(--text-muted);">
                    @foreach($viewsByDay as $dayData)
                        <span style="width: 10%; text-align: center;">{{ $dayData['day'] }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Device breakdown -->
            <div class="bento-box" style="padding: 2rem;">
                <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">Visitor Devices</h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2rem;">Browser breakdown share.</p>

                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- Desktop Share -->
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem;">
                            <span style="display: flex; align-items: center; gap: 0.5rem;">
                                <span style="width: 12px; height: 12px; background: var(--primary); border-radius: 3px;"></span>
                                Desktop
                            </span>
                            <span>{{ $deviceShare['desktop'] }}%</span>
                        </div>
                        <div style="height: 8px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                            <div style="width: {{ $deviceShare['desktop'] }}%; height: 100%; background: var(--primary);"></div>
                        </div>
                    </div>

                    <!-- Mobile Share -->
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem;">
                            <span style="display: flex; align-items: center; gap: 0.5rem;">
                                <span style="width: 12px; height: 12px; background: var(--accent); border-radius: 3px;"></span>
                                Mobile
                            </span>
                            <span>{{ $deviceShare['mobile'] }}%</span>
                        </div>
                        <div style="height: 8px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                            <div style="width: {{ $deviceShare['mobile'] }}%; height: 100%; background: var(--accent);"></div>
                        </div>
                    </div>

                    <!-- Tablet Share -->
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem;">
                            <span style="display: flex; align-items: center; gap: 0.5rem;">
                                <span style="width: 12px; height: 12px; background: #A78BFA; border-radius: 3px;"></span>
                                Tablet
                            </span>
                            <span>{{ $deviceShare['tablet'] }}%</span>
                        </div>
                        <div style="height: 8px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                            <div style="width: {{ $deviceShare['tablet'] }}%; height: 100%; background: #A78BFA;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
@endsection
