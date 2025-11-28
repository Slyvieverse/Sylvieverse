<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
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
