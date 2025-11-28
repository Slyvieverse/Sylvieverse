<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;
    public $recipientName;

    /**
     * Create a new message instance.
     */
    public function __construct(array $formData, string $recipientName = 'Support Team')
    {
        $this->formData = $formData;
        $this->recipientName = $recipientName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'New Contact Form: ' . $this->formData['subject'];

        // Truncate long subjects to avoid email client issues
        if (strlen($subject) > 78) {
            $subject = substr($subject, 0, 75) . '...';
        }

        return new Envelope(
            subject: $subject,
            replyTo: [
                $this->formData['email'] => $this->formData['first_name'] . ' ' . $this->formData['last_name']
            ],
          
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: [
                'formData' => $this->formData,
                'recipientName' => $this->recipientName,
                'submissionTime' => now()->format('F j, Y \a\t g:i A T'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-form')
                    ->with([
                        'formData' => $this->formData,
                        'recipientName' => $this->recipientName,
                        'submissionTime' => now()->format('F j, Y \a\t g:i A T'),
                    ]);
    }
}
