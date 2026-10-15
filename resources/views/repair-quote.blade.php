<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoFix Hub - Create Quote</title>
    <link rel="stylesheet" href="{{ asset('css/autofix.css') }}">

</head>
<body>
    <main>
        <h1>Create repair quote</h1>

        <h2>{{ $repairRequest->vehicle }} ({{ $repairRequest->year }})</h2>
        <p><strong>Customer:</strong> {{ $repairRequest->customer_name ?? 'Not provided' }}</p>
        <p><strong>Damage:</strong> {{ $repairRequest->description }}</p>

        @if ($errors->any())
            <div class="error">
                <p>Please correct the following:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/requests/{{ $repairRequest->id }}/quote" method="POST">
            @csrf

            <label for="parts_cost">Parts cost ($)</label>
            <input
                id="parts_cost"
                name="parts_cost"
                type="number"
                min="0"
                step="0.01"
                value="{{ old('parts_cost', '0.00') }}"
                required
            >

            <label for="labor_cost">Labour cost ($)</label>
            <input
                id="labor_cost"
                name="labor_cost"
                type="number"
                min="0"
                step="0.01"
                value="{{ old('labor_cost', '0.00') }}"
                required
            >

            <label for="tax_amount">Tax amount ($)</label>
            <input
                id="tax_amount"
                name="tax_amount"
                type="number"
                min="0"
                step="0.01"
                value="{{ old('tax_amount', '0.00') }}"
                required
            >

            <label for="notes">Notes for the customer (optional)</label>
            <textarea
                id="notes"
                name="notes"
                rows="4"
            >{{ old('notes') }}</textarea>

            <button type="submit">Save quote</button>
        </form>

        <p><a href="/requests">Back to repair requests</a></p>
    </main>
</body>
</html>