<?php

namespace App\Mail;

use App\Models\Auction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuctionWonPayNow extends Mailable
{
    use Queueable, SerializesModels;

    public $auction;
    public $paymentUrl;

    public function __construct(Auction $auction, string $paymentUrl)
    {
        $this->auction = $auction;
        $this->paymentUrl = $paymentUrl;
    }

    public function build()
    {
        return $this->subject("YOU WON #{$this->auction->id} – PAY NOW TO CLAIM")
                    ->markdown('emails.auctions.won-pay-now');
    }
}
