<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AutoFix Hub</title>
    <link rel="stylesheet" href="{{ asset('css/autofix.css') }}">
</head>
<body>
    <main>
        <h1>Create your customer account</h1>
        <p>Register to use AutoFix Hub.</p>

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

        <form action="/register" method="POST">
            @csrf

            <label for="name">Name</label>
            <input
                id="name"
                name="name"
                value="{{ old('name') }}"
                autocomplete="name"
                required
            >

            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
            >

            <label for="password">Password (at least 8 characters)</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                required
            >

            <label for="password_confirmation">Confirm password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                required
            >

            <button type="submit">Create account</button>
        </form>

        <p>Already registered? <a href="/login">Log in</a></p>
    </main>
</body>
</html>