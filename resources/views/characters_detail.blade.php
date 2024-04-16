
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $character->name }}</title>
</head>
<body>
    <h1>{{ $character->name }}</h1>

    <p>Defensive: {{ $character->defence  }}</p>
    <p>Offensive: {{ $character->strength  }}</p>
    <p>Accuracy: {{ $character->accuracy }}</p>
    <p>Magical Ability: {{ $character->magic  }}</p>

    <h2>Matches</h2>
<ul>
    @foreach ($contests as $contest)
        @php
  $location = $contest->place->name;

  $opponent = $contest->characters()->where('character_id', '!=', $character->id)->first()->name;
        @endphp
        <li><a href="{{ route('contests.show', $contest->id) }}">{{ $location }} vs. {{ $opponent }}</a></li>
    @endforeach
</ul>

    <!-- Add edit, delete, and new match buttons here -->
</body>
</html>
