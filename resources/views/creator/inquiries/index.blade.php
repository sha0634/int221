@extends('layouts.creator')

@section('header_title', 'Client Inquiries')

@section('content')
<div style="max-width: 1000px; margin: 0 auto;">

    @if(session('success'))
        <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <div class="bento-box" style="padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">Inbox</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Manage and respond to client opportunities directly from your public portfolio.</p>
            </div>
            <span style="background: #EEF2FF; color: var(--accent); font-weight: 600; font-size: 0.85rem; padding: 0.4rem 1rem; border-radius: 99px;">
                {{ $inquiries->count() }} Total
            </span>
        </div>

        @if($inquiries->isEmpty())
            <div style="text-align: center; padding: 4rem 2rem; background: #F8FAFC; border-radius: 16px; border: 2px dashed #E2E8F0;">
                <div style="width: 64px; height: 64px; background: #EEF2FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                    <svg width="28" height="28" fill="none" stroke="var(--accent)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem;">No inquiries yet</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; max-width: 320px; margin: 0 auto 1.5rem auto;">When clients visit your live portfolio and send a message, it will instantly appear here.</p>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($inquiries as $inquiry)
                    <div style="border: 1px solid #E2E8F0; border-radius: 16px; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; transition: all 0.2s; background: white;" onmouseover="this.style.borderColor='var(--accent)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.05)';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none';">
                        <div style="flex: 1; min-width: 0; padding-right: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--primary); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $inquiry->subject }}
                                </h3>
                                @if($inquiry->status === 'new')
                                    <span style="background: #EEF2FF; color: var(--accent); font-size: 0.75rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 6px;">New</span>
                                @else
                                    <span style="background: #ECFDF5; color: #10B981; font-size: 0.75rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 6px;">Replied</span>
                                @endif
                            </div>
                            
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                                From <span style="color: var(--primary); font-weight: 600;">{{ $inquiry->client_name }}</span> ({{ $inquiry->client_email }}) &bull; {{ $inquiry->created_at->diffForHumans() }}
                            </p>
                            
                            <p style="font-size: 0.9rem; color: #475569; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 600px;">
                                "{{ $inquiry->message }}"
                            </p>
                        </div>
                        
                        <div>
                            <a href="{{ route('creator.inquiries.show', $inquiry->id) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--primary); color: white; padding: 0.6rem 1.25rem; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='var(--accent)';" onmouseout="this.style.background='var(--primary)';">
                                Open Details
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
