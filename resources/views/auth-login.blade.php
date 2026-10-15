<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - AutoFix Hub</title>
    <link rel="stylesheet" href="{{ asset('css/autofix.css') }}">
</head>
<body>
    <main>
        <h1>Log in to AutoFix Hub</h1>

        @if ($errors->any())
            <div class="error">
                <p>There was a problem signing in:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
            >

            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Log in</button>
        </form>

        <p>New to AutoFix Hub? <a href="/register">Create an account</a></p>
    </main>
</body>
</html>