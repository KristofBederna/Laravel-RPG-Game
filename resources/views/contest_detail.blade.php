<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest details</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 20px;
}

p {
    margin-left: 20px;
}

strong {
    font-weight: bold;
}
.dashboardButton {
  width: 10%;
}
</style>
<body>
<button class="dashboardButton" onclick="window.location.href = '{{ route('dashboard') }}';">Dashboard</button>
    <h2>Contest Details</h2>

    @if ($contest)
        <p><strong>Location:</strong> {{ $contest->place->name }}</p>
        <p><strong>Opponent:</strong> {{ $contest->characters()->where('character_id', '!=', $character)->first()->name }}</p>
    @else
        <p>Contest not found.</p>
    @endif
    <button onclick="window.location.href = '{{ route('characters') }}';">Characters</button>
</body>
</html>