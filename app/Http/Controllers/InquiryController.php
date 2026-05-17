<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function index()
    {
        $portfolio = Auth::user()->portfolio;
        $inquiries = $portfolio ? $portfolio->inquiries()->latest()->get() : collect();
        
        return view('creator.inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        if ($inquiry->portfolio->user_id !== Auth::id()) {
            abort(403);
        }

        return view('creator.inquiries.show', compact('inquiry'));
    }

    public function reply(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        if ($inquiry->portfolio->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $replies = $inquiry->replies ?? [];
        $replies[] = [
            'sender' => 'creator',
            'message' => $request->message,
            'created_at' => now()->toIso8601String(),
        ];

        $inquiry->update([
            'replies' => $replies,
            'status' => 'replied',
        ]);

        return redirect()->route('creator.inquiries.show', $inquiry->id)->with('success', 'Reply submitted successfully!');
    }

    public function store(Request $request, $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();

        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $portfolio->inquiries()->create([
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        return back()->with('success', 'Your inquiry has been sent successfully! The creator will review and reply soon.');
    }
}
