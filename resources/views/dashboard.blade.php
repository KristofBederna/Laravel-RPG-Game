<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    display:grid;
    justify-items: center;
    align-items: center;
    justify-content: center;
    align-content: center;
}

h1 {
    text-align: center;
    margin-top: 50px;
    color: #333;
}

p {
    text-align: center;
    margin-top: 20px;
    color: #666;
}

form, button {
    display: block;
    margin: 0 auto;
}

button {
  appearance: none;
  background-color: #000000;
  border: 2px solid #1A1A1A;
  border-radius: 15px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  font-family: Roobert, -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 16px;
  font-weight: 600;
  line-height: normal;
  margin: 0;
  outline: none;
  text-align: center;
  text-decoration: none;
  transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  will-change: transform;
  border: none;
  cursor: pointer;
  margin-bottom: 10px;
}

button:disabled {
  pointer-events: none;
}

button:hover {
  box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
  transform: translateY(-2px);
}

button:active {
  box-shadow: none;
  transform: translateY(0);
}

button:hover {
  background-color: #0056b3;
}

.logout-form {
    text-align: center;
    margin-top: 20px;
}

#buttons {
    display: flex;
}

    </style>
</head>
<body>
    <h1>Welcome to the Dashboard, {{ Auth::user()->name }}!</h1>
<div id="buttons">
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <button onclick="window.location.href = '{{ route('characters') }}';">Characters</button>
    @if(Auth::user()->admin)
    <button onclick="window.location.href = '{{ route('places') }}';">Places</button>
    @endif
</div>
</body>
</html>
