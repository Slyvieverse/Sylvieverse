{{-- resources/views/emails/auctions/sold.blade.php --}}
<x-mail::message>
# YOUR ITEM JUST SOLD!

**Product:** {{ $auction->product->name }}
**Sold for:** ${{ number_format($auction->current_bid, 2) }}
**Winner:** {{ $auction->winner->name }} ({{ $auction->winner->email }})
**Auction:** #{{ $auction->id }}

Payment pending – you’ll receive funds once the winner pays.

<x-mail::button :url="route('auctions.show', $auction)">
View Auction
</x-mail::button>

{{ config('app.name') }}
</x-mail::message>
