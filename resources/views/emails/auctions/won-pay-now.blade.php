{{-- resources/views/emails/auctions/won-pay-now.blade.php --}}
<x-mail::message>
# YOU WON THE AUCTION!

**Congratulations!** You are the highest bidder on:

**{{ $auction->product->name }}**

**Winning Bid:** ${{ number_format($auction->current_bid, 2) }}

**Auction ends in:** {{ $auction->planned_end_time->diffForHumans() }}

<x-mail::button :url="$paymentUrl" color="success">
PAY NOW & CLAIM YOUR ITEM
</x-mail::button>

This link expires in 24 hours. If you don't pay, the item will go to the next bidder.

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
