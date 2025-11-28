{{-- resources/views/auctions/pay-now.blade.php --}}
<x-app-layout>
<div class="min-h-screen bg-black text-white flex items-center justify-center p-8">
    <div class="max-w-2xl w-full bg-gradient-to-br from-purple-900/50 to-pink-900/50 backdrop-blur-xl rounded-3xl p-12 border-4 border-purple-600 shadow-2xl">
        <h1 class="text-6xl font-black text-center mb-8 bg-gradient-to-r from-yellow-400 to-pink-500 bg-clip-text text-transparent">
            YOU WON!
        </h1>

        <div class="text-center mb-10">
            <img src="{{ asset('storage/' . $auction->product->image_url) }}" class="w-64 mx-auto rounded-2xl shadow-2xl">
            <h2 class="text-4xl font-bold mt-6">{{ $auction->product->name }}</h2>
            <p class="text-6xl font-black text-green-400 mt-4">
                ${{ number_format($auction->current_bid, 2) }}
            </p>
        </div>

        <div id="payment-element"></div>
        <button id="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-2xl py-6 rounded-2xl mt-8 hover:scale-105 transition">
            PAY NOW & CLAIM
        </button>

        <p class="text-center mt-6 text-gray-400">This link expires in 24 hours</p>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements({ clientSecret: '{{ $pi }}' });
    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');

    document.getElementById('submit').addEventListener('click', async () => {
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: { return_url: "{{ route('auction.payment.success', $auction) }}" }
        });
    });
</script>
</x-app-layout>
