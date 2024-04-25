<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Overview</title>
    <link rel="stylesheet" href="{{ asset('css/styleWelcome.css') }}">
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Game Overview</h1>
    <p>Welcome to our game!</p>
  </div>
  <div class="formArea">
  <p>Please login or register to continue:</p>
  <div>
    <div id="loginForm">
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

            <button role="button" type="submit">Login</button>
        </form>
    </div>

    <div id="registerForm" style="display: none;">
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

            <button role="button" type="submit">Register</button>
        </form>
    </div>
    <button id="toggleFormButton" role="button">Switch to Register</button>
</div>
  </div>
  <div class="characters">
  Total Characters<br>
    {{ $numberOfCharacters }}
  </div>
  <div class="matches">
  Total Matches Played<br>
   {{ $numberOfContests }}
  </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleFormButton = document.getElementById('toggleFormButton');
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');

            toggleFormButton.addEventListener('click', function() {
                if (loginForm.style.display === 'none') {
                    loginForm.style.display = 'block';
                    registerForm.style.display = 'none';
                    toggleFormButton.textContent = 'Switch to Register';
                } else {
                    loginForm.style.display = 'none';
                    registerForm.style.display = 'block';
                    toggleFormButton.textContent = 'Switch to Login';
                }
            });
        });
    </script>
</body>
</html>
