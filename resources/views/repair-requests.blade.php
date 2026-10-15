<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoFix Hub - Repair Requests</title>
    <link rel="stylesheet" href="{{ asset('css/autofix.css') }}">
</head>
<body>
    <main>
        <h1>Repair requests</h1>

        <p>
            Signed in as
            <strong>{{ auth()->user()->name }}</strong>
            ({{ auth()->user()->role }})
        </p>

        @if (auth()->user()->role === 'customer')
            <p><a href="/">Submit another request</a></p>
        @endif

        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Log out</button>
        </form>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @forelse ($requests as $request)
            <article class="request">
                <h2>{{ $request->vehicle }} ({{ $request->year }})</h2>

                <p><strong>Customer:</strong> {{ $request->customer_name ?? 'Not provided' }}</p>
                <p><strong>Email:</strong> {{ $request->customer_email ?? 'Not provided' }}</p>
                <p><strong>Phone:</strong> {{ $request->customer_phone ?? 'Not provided' }}</p>
                <p><strong>Damage:</strong> {{ $request->description }}</p>
                <p><strong>Status:</strong> <span class="status">{{ $request->status }}</span></p>
                <p><strong>Submitted:</strong> {{ $request->created_at->format('d M Y, g:i a') }}</p>

                @if ($request->photos->isNotEmpty())
                    <h3>Damage photos</h3>
                    @foreach ($request->photos as $photo)
                        <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" rel="noopener noreferrer">
                            <img
                                src="{{ asset('storage/' . $photo->photo_path) }}"
                                alt="Damage photo for {{ $request->vehicle }}"
                                loading="lazy"
                                style="width: 180px; height: 140px; object-fit: cover; border-radius: 12px; margin: 0 10px 10px 0;"
                            >
                        </a>
                    @endforeach
                @endif

                @if (auth()->user()->role === 'repairer')
                    <a class="button" href="/requests/{{ $request->id }}/quote">Create a quote</a>
                @endif

                @foreach ($request->quotes as $quote)
                    <section class="quote">
                        <h3>Quote — {{ $quote->status }}</h3>
                        <p><strong>Parts:</strong> ${{ number_format($quote->parts_cost, 2) }}</p>
                        <p><strong>Labour:</strong> ${{ number_format($quote->labor_cost, 2) }}</p>
                        <p><strong>Tax:</strong> ${{ number_format($quote->tax_amount, 2) }}</p>
                        <p><strong>Total:</strong> ${{ number_format($quote->parts_cost + $quote->labor_cost + $quote->tax_amount, 2) }}</p>

                        @if ($quote->notes)
                            <p><strong>Notes:</strong> {{ $quote->notes }}</p>
                        @endif

                        @if (
                            auth()->user()->role === 'customer'
                            && $request->user_id == auth()->id()
                            && $quote->status === 'Submitted'
                        )
                            <form action="/quotes/{{ $quote->id }}/accept" method="POST">
                                @csrf
                                <button class="button accept-button" type="submit">Accept quote</button>
                            </form>
                        @elseif (
                            auth()->user()->role === 'repairer'
                            && $quote->status === 'Accepted'
                        )
                            <form action="/quotes/{{ $quote->id }}/complete" method="POST">
                                @csrf
                                <button class="button complete-button" type="submit">Mark repair completed</button>
                            </form>
                        @endif
                    </section>
                @endforeach
            </article>
        @empty
            <p>No repair requests yet.</p>
        @endforelse
    </main>
</body>
</html>