@extends('layouts.creator')

@section('header_title', 'Inquiry Details')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">

    <a href="{{ route('creator.inquiries.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.9rem; margin-bottom: 1.5rem; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)';" onmouseout="this.style.color='var(--text-muted)';">
        &larr; Back to Inbox
    </a>

    @if(session('success'))
        <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Inquiry Card Info -->
    <div class="bento-box" style="padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #E2E8F0; padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem;">{{ $inquiry->subject }}</h2>
                <p style="font-size: 0.9rem; color: var(--text-muted);">
                    From <strong style="color: var(--primary);">{{ $inquiry->client_name }}</strong> (<a href="mailto:{{ $inquiry->client_email }}" style="color: var(--accent); text-decoration: none;">{{ $inquiry->client_email }}</a>)
                </p>
            </div>
            <div style="text-align: right;">
                <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">
                    {{ $inquiry->created_at->format('M d, Y &bull; h:i A') }}
                </span>
                @if($inquiry->status === 'new')
                    <span style="background: #EEF2FF; color: var(--accent); font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.75rem; border-radius: 6px; display: inline-block;">New Message</span>
                @else
                    <span style="background: #ECFDF5; color: #10B981; font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.75rem; border-radius: 6px; display: inline-block;">Replied</span>
                @endif
            </div>
        </div>

        <!-- Timeline / Conversation History -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2.5rem;">
            
            <!-- Original Client Message Bubble -->
            <div style="display: flex; gap: 1rem; align-items: flex-start;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: #EEF2FF; display: flex; align-items: center; justify-content: center; font-weight: 600; color: var(--accent); flex-shrink: 0;">
                    {{ substr($inquiry->client_name, 0, 1) }}
                </div>
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1.25rem; border-radius: 0 16px 16px 16px; flex: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="font-weight: 600; font-size: 0.9rem; color: var(--primary);">{{ $inquiry->client_name }}</span>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $inquiry->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="font-size: 0.95rem; color: #334155; line-height: 1.6; white-space: pre-line;">{{ $inquiry->message }}</p>
                </div>
            </div>

            <!-- Custom replies list (JSON dynamic load) -->
            @if($inquiry->replies)
                @foreach($inquiry->replies as $reply)
                    <div style="display: flex; gap: 1rem; align-items: flex-start; justify-content: flex-end;">
                        <div style="background: #EEF2FF; border: 1px solid rgba(79, 70, 229, 0.15); padding: 1.25rem; border-radius: 16px 0 16px 16px; flex: 1; max-width: 85%;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-weight: 600; font-size: 0.9rem; color: var(--accent);">You (Creator)</span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">
                                    {{ \Carbon\Carbon::parse($reply['created_at'])->diffForHumans() }}
                                </span>
                            </div>
                            <p style="font-size: 0.95rem; color: #1E293B; line-height: 1.6; white-space: pre-line;">{{ $reply['message'] }}</p>
                        </div>
                        <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 600; color: white; flex-shrink: 0;">
                            {{ substr($inquiry->portfolio->user->name, 0, 1) }}
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <!-- Reply Entry Box Form -->
        <div style="border-top: 1px solid #E2E8F0; padding-top: 2rem;">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="18" height="18" fill="none" stroke="var(--accent)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                Send Reply
            </h3>

            <form action="{{ route('creator.inquiries.reply', $inquiry->id) }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.25rem;">
                    <textarea name="message" rows="5" style="width: 100%; border: 1px solid #D1D5DB; border-radius: 12px; padding: 1rem; font-size: 0.95rem; outline: none; transition: border 0.2s; resize: vertical;" placeholder="Type your reply to {{ $inquiry->client_name }} here..." required onfocus="this.style.borderColor='var(--accent)';" onblur="this.style.borderColor='#D1D5DB';"></textarea>
                    @error('message')
                        <p style="color: #EF4444; font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" style="background: var(--accent); color: white; border: none; padding: 0.75rem 2rem; border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='var(--accent-hover)';" onmouseout="this.style.background='var(--accent)';">
                        Submit Reply
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>
@endsection
