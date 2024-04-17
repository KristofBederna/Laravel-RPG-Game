<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest details</title>
</head>
<body>
    <h2>Contest Details</h2>

    @if ($contest)
        <p><strong>Location:</strong> {{ $contest->place->name }}</p>
        <p><strong>Won:</strong> {{ $contest->win }}</p>
        <p><strong>Opponent:</strong> {{ $contest->characters()->where('character_id', '!=', $character)->first()->name }}</p>
    @else
        <p>Contest not found.</p>
    @endif
</body>
</html>