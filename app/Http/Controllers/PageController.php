<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
    
class PageController extends Controller
{
  public function home()
{
    $featuredAuctions = Auction::with('product')
        ->where('status', 'active')
        ->orderByDesc('current_bid')
        ->limit(6)
        ->get();

    $recentActivity = Bid::with(['bidder', 'auction.product'])
        ->latest()
        ->limit(8)
        ->get()
        ->map(function($bid) {
            return [
                'time' => $bid->created_at->diffForHumans(),
                'user' => $bid->bidder->name ?? 'Unknown User',
                'action' => 'placed a bid on',
                'product' => $bid->auction->product->name ?? 'Unknown Product',
                'amount' => number_format($bid->amount, 2) . ' USD',
            ];
        });

    $totalCollectors = User::count();

    return view('welcome', compact('featuredAuctions', 'recentActivity', 'totalCollectors'));
}
       public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
       public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        try {
            // Determine recipient based on subject
            $recipient = $this->getRecipientEmail($validated['subject']);

            // Send email
            Mail::to($recipient)->send(new ContactFormSubmitted($validated));

            // Optional: Save to database
            // ContactSubmission::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully! We\'ll get back to you within 24 hours.'
            ]);

        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again or email us directly.'
            ], 500);
        }
    }

    /**
     * Determine recipient email based on subject
     */
    private function getRecipientEmail(string $subject): string
    {
        return match($subject) {
            'technical' => 'support@sylvieverse.com',
            'partnership' => 'partners@sylvieverse.com',
            'billing' => 'billing@sylvieverse.com',
            default => 'hello@sylvieverse.com'
        };
    }
}
