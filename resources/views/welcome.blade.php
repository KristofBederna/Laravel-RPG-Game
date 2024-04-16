<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Overview</title>
</head>
<body>
    <h1>Game Overview</h1>
    <p>Welcome to our game!</p>

    <p>Please login or register to continue:</p>

    <!-- Login form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="login-email">Email</label>
            <input id="login-email" type="email" name="email" required autofocus>
        </div>

        <div>
            <label for="login-password">Password</label>
            <input id="login-password" type="password" name="password" required autocomplete="current-password">
        </div>

        <button type="submit">Login</button>
    </form>

    <br>

    <!-- Register form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="register-name">Name</label>
            <input id="register-name" type="text" name="name" required>
        </div>

        <div>
            <label for="register-email">Email</label>
            <input id="register-email" type="email" name="email" required>
        </div>

        <div>
            <label for="register-password">Password</label>
            <input id="register-password" type="password" name="password" required autocomplete="new-password">
        </div>

        <div>
            <label for="register-password-confirm">Confirm Password</label>
            <input id="register-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit">Register</button>
    </form>

    <!-- Statistics -->
    <h2>Statistics</h2>
    <ul>
        <li>Total Characters: {{ $numberOfCharacters }}</li>
        <li>Total Matches Played: {{ $numberOfContests }}</li>
    </ul>
</body>
</html>
