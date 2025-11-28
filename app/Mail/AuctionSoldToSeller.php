<?php

namespace App\Mail;

use App\Models\Auction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuctionSoldToSeller extends Mailable
{
    use Queueable, SerializesModels;

    public $auction;  // ← Make it public so Blade can access it

    /**
     * Create a new message instance.
     */
    public function __construct(public Auction $this)
    {
        // Laravel 11 automatically injects it — no need to do anything here
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "YOUR ITEM SOLD! – {$this->auction->product->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.auctions.sold',
            with: [
                'auction' => $this->auction,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
