<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoFix Hub - Repair Request</title>
    <link rel="stylesheet" href="{{ asset('css/autofix.css') }}">
</head>
<body>
    <main>
        <h1>Request a vehicle repair quote</h1>
        <p>Enter your contact and vehicle details, describe the damage, and add photos if you have them.</p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

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

        <form action="/repair-requests" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="customer_name">Your name</label>
            <input id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>

            <label for="customer_email">Email</label>
            <input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email') }}" required>

            <label for="customer_phone">Phone (optional)</label>
            <input id="customer_phone" name="customer_phone" type="tel" value="{{ old('customer_phone') }}">

            <label for="vehicle">Vehicle (make and model)</label>
            <input id="vehicle" name="vehicle" value="{{ old('vehicle') }}" required>

            <label for="year">Year</label>
            <input id="year" name="year" type="number" min="1900" max="2100" value="{{ old('year') }}" required>

            <label for="description">Damage description</label>
            <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>

            <label for="photos">Damage photos (optional, up to 5 images)</label>
            <input
                id="photos"
                name="photos[]"
                type="file"
                accept=".jpg,.jpeg,.png,.webp"
                multiple
            >

            <button type="submit">Submit request</button>
        </form>
    </main>
</body>
</html>